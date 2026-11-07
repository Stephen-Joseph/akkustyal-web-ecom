<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\ImageRole;
use App\Enums\ProductStatus;
use App\Enums\ProductType;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function getTestAdminUser(): Admin
{
    return Admin::firstOrCreate(
        ['email' => 'admin-media-test@example.com'],
        [
            'username' => 'mediamanager',
            'name' => 'Media Manager Admin',
            'password' => 'secret-password',
            'role' => 'admin',
        ]
    );
}

function createSampleProduct(): Product
{
    $brand = Brand::first() ?? Brand::create([
        'name' => 'Test Silk Mill',
        'slug' => 'test-silk-mill-'.uniqid(),
        'is_active' => true,
    ]);

    return Product::create([
        'brand_id' => $brand->id,
        'name' => 'Kanchipuram Silk Saree',
        'slug' => 'kanchipuram-silk-saree-'.uniqid(),
        'product_type' => ProductType::Simple,
        'status' => ProductStatus::Active,
        'short_description' => 'Pure handwoven silk saree.',
        'base_attributes' => ['fabric' => 'Silk'],
    ]);
}

test('guest cannot upload product images and is redirected to admin login', function (): void {
    $product = createSampleProduct();

    $this->post(route('admin.products.images.store', $product), [
        'image_url' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35',
        'image_role' => ImageRole::Gallery->value,
    ])->assertRedirect(route('admin.login'));
});

test('admin can upload an image file to a product', function (): void {
    Storage::fake('public');
    $admin = getTestAdminUser();
    $product = createSampleProduct();

    $file = UploadedFile::fake()->image('saree-front.jpg', 800, 1000);

    $response = $this->actingAs($admin, 'admin')
        ->post(route('admin.products.images.store', $product), [
            'image_file' => $file,
            'image_role' => ImageRole::Thumbnail->value,
            'alt_text' => 'Front pleats detail',
            'is_primary' => '1',
        ]);

    $response->assertRedirect(route('admin.products.show', $product))
        ->assertSessionHas('success');

    $productImage = ProductImage::where('product_id', $product->id)->first();
    expect($productImage)->not->toBeNull()
        ->and($productImage->is_primary)->toBeTrue()
        ->and($productImage->alt_text)->toBe('Front pleats detail')
        ->and($productImage->image_role)->toBe(ImageRole::Thumbnail);

    $masterImage = $productImage->image;
    expect($masterImage->storage_disk)->toBe('public')
        ->and($masterImage->width_px)->toBe(800)
        ->and($masterImage->height_px)->toBe(1000);

    Storage::disk('public')->assertExists($masterImage->file_path);
});

test('admin can link an external CDN image URL to a product', function (): void {
    $admin = getTestAdminUser();
    $product = createSampleProduct();
    $externalUrl = 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=1200&q=80';

    $response = $this->actingAs($admin, 'admin')
        ->post(route('admin.products.images.store', $product), [
            'image_url' => $externalUrl,
            'image_role' => ImageRole::Gallery->value,
            'alt_text' => 'Pallu motifs',
        ]);

    $response->assertRedirect(route('admin.products.show', $product))
        ->assertSessionHas('success');

    $productImage = ProductImage::where('product_id', $product->id)->first();
    expect($productImage)->not->toBeNull()
        ->and($productImage->image->cdn_url)->toBe($externalUrl)
        ->and($productImage->image->storage_disk)->toBe('external');
});

test('admin can switch primary image and existing primary is safely demoted', function (): void {
    $admin = getTestAdminUser();
    $product = createSampleProduct();

    // Create 2 images
    $img1 = Image::create([
        'storage_disk' => 'external',
        'image_name' => 'image-1',
        'file_path' => 'https://example.com/1.jpg',
        'cdn_url' => 'https://example.com/1.jpg',
        'mime_type' => 'image/jpeg',
        'extension' => 'jpg',
        'file_size_bytes' => 100,
    ]);

    $img2 = Image::create([
        'storage_disk' => 'external',
        'image_name' => 'image-2',
        'file_path' => 'https://example.com/2.jpg',
        'cdn_url' => 'https://example.com/2.jpg',
        'mime_type' => 'image/jpeg',
        'extension' => 'jpg',
        'file_size_bytes' => 100,
    ]);

    $pi1 = ProductImage::create([
        'product_id' => $product->id,
        'image_id' => $img1->id,
        'image_name' => 'Image 1',
        'alt_text' => 'Alt 1',
        'image_role' => ImageRole::Thumbnail,
        'is_primary' => true,
        'sort_order' => 1,
    ]);

    $pi2 = ProductImage::create([
        'product_id' => $product->id,
        'image_id' => $img2->id,
        'image_name' => 'Image 2',
        'alt_text' => 'Alt 2',
        'image_role' => ImageRole::Gallery,
        'is_primary' => false,
        'sort_order' => 2,
    ]);

    // Promote pi2 to primary
    $this->actingAs($admin, 'admin')
        ->patch(route('admin.products.images.primary', [$product, $pi2]))
        ->assertRedirect(route('admin.products.show', $product))
        ->assertSessionHas('success');

    expect($pi1->fresh()->is_primary)->toBeFalse()
        ->and($pi2->fresh()->is_primary)->toBeTrue();
});

test('admin can delete product image and next available image is promoted if primary was deleted', function (): void {
    Storage::fake('public');
    $admin = getTestAdminUser();
    $product = createSampleProduct();

    $file = UploadedFile::fake()->image('delete-me.jpg', 600, 600);
    $path = $file->store("products/{$product->id}", 'public');

    $masterImage = Image::create([
        'storage_disk' => 'public',
        'image_name' => 'delete-me',
        'file_path' => $path,
        'cdn_url' => Storage::disk('public')->url($path),
        'mime_type' => 'image/jpeg',
        'extension' => 'jpg',
        'file_size_bytes' => 500,
    ]);

    $primaryPi = ProductImage::create([
        'product_id' => $product->id,
        'image_id' => $masterImage->id,
        'image_name' => 'Primary Image',
        'alt_text' => 'Primary Alt',
        'image_role' => ImageRole::Thumbnail,
        'is_primary' => true,
        'sort_order' => 1,
    ]);

    $secondImage = Image::create([
        'storage_disk' => 'external',
        'image_name' => 'fallback-second',
        'file_path' => 'https://example.com/fallback.jpg',
        'cdn_url' => 'https://example.com/fallback.jpg',
        'mime_type' => 'image/jpeg',
        'extension' => 'jpg',
        'file_size_bytes' => 100,
    ]);

    $secondPi = ProductImage::create([
        'product_id' => $product->id,
        'image_id' => $secondImage->id,
        'image_name' => 'Second Image',
        'alt_text' => 'Second Alt',
        'image_role' => ImageRole::Gallery,
        'is_primary' => false,
        'sort_order' => 2,
    ]);

    // Delete primaryPi
    $this->actingAs($admin, 'admin')
        ->delete(route('admin.products.images.destroy', [$product, $primaryPi]))
        ->assertRedirect(route('admin.products.show', $product))
        ->assertSessionHas('success');

    expect(ProductImage::find($primaryPi->id))->toBeNull()
        ->and($secondPi->fresh()->is_primary)->toBeTrue()
        ->and(Image::find($masterImage->id))->toBeNull(); // Cleaned up orphaned physical record

    Storage::disk('public')->assertMissing($path);
});

test('admin can create product with an initial primary image via URL or upload', function (): void {
    $admin = getTestAdminUser();
    $slug = 'embroidered-kurti-'.uniqid();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.products.store'), [
            'name' => 'Embroidered Kurti',
            'slug' => $slug,
            'product_type' => ProductType::Simple->value,
            'status' => ProductStatus::Active->value,
            'primary_image_url' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35',
            'primary_image_alt' => 'Embroidered Kurti Front',
        ])
        ->assertRedirect();

    $product = Product::where('slug', $slug)->first();
    expect($product)->not->toBeNull()
        ->and($product->productImages)->toHaveCount(1)
        ->and($product->productImages->first()->is_primary)->toBeTrue()
        ->and($product->primary_image)->toBe('https://images.unsplash.com/photo-1594938298603-c8148c4dae35');
});

test('store image endpoint rejects request with neither file nor url', function (): void {
    $admin = getTestAdminUser();
    $product = createSampleProduct();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.products.images.store', $product), [
            'image_role' => ImageRole::Gallery->value,
        ])
        ->assertSessionHasErrors(['image_file']);
});
