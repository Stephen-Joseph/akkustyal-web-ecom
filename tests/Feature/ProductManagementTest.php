<?php

use App\Actions\Product\CreateProductAction;
use App\Actions\Product\CreateProductVariantAction;
use App\Enums\ProductStatus;
use App\Enums\ProductType;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create a product via CreateProductAction', function (): void {
    $brand = Brand::factory()->create();
    $category = Category::factory()->create(['path' => 'womens', 'depth' => 0]);

    $action = app(CreateProductAction::class);

    $product = $action->execute([
        'brand_id' => $brand->id,
        'name' => 'Classic Cotton Kurta',
        'slug' => 'classic-cotton-kurta',
        'product_type' => ProductType::Configurable->value,
        'status' => ProductStatus::Active->value,
        'short_description' => 'A timeless kurta.',
        'description' => null,
        'base_attributes' => ['fabric' => 'Cotton'],
        'seo_metadata' => [],
        'published_at' => now()->toDateTimeString(),
        'category_ids' => [$category->id],
        'primary_category_id' => $category->id,
    ]);

    expect($product)->toBeInstanceOf(Product::class)
        ->and($product->name)->toBe('Classic Cotton Kurta')
        ->and($product->status)->toBe(ProductStatus::Active)
        ->and($product->categories)->toHaveCount(1);
});

it('creates a variant with an INR price via CreateProductVariantAction', function (): void {
    $product = Product::factory()->create();

    $action = app(CreateProductVariantAction::class);

    $variant = $action->execute($product, [
        'sku' => 'TEST-SKU-001',
        'barcode' => null,
        'name' => 'M / White',
        'is_default' => true,
        'is_active' => true,
        'track_inventory' => true,
        'weight_grams' => 300,
        'length_mm' => 0,
        'width_mm' => 0,
        'height_mm' => 0,
        'variant_options' => ['size' => 'M', 'color' => 'White'],
        'technical_specs' => [],
        'media_gallery' => [],
        'sort_order' => 0,
        'msrp_price' => 2500.00,
        'retail_price' => 1999.00,
        'cost_price' => null,
        'sale_price' => null,
        'sale_starts_at' => null,
        'sale_ends_at' => null,
    ]);

    expect($variant)->toBeInstanceOf(ProductVariant::class)
        ->and($variant->sku)->toBe('TEST-SKU-001')
        ->and($variant->is_default)->toBeTrue()
        ->and($variant->inrPrice->retail_price)->toBe('1999.00');
});

it('scopes active products by status', function (): void {
    Product::factory()->create(['status' => ProductStatus::Active, 'published_at' => now()]);
    Product::factory()->draft()->create();
    Product::factory()->archived()->create();

    $activeProducts = Product::active()->get();

    expect($activeProducts)->toHaveCount(1);
});

it('filters products by JSONB base_attributes containment', function (): void {
    Product::factory()->create(['base_attributes' => ['fabric' => 'Cotton', 'occasion' => ['Casual']]]);
    Product::factory()->create(['base_attributes' => ['fabric' => 'Silk']]);

    $cottonProducts = Product::withBaseAttributes(['fabric' => 'Cotton'])->get();

    expect($cottonProducts)->toHaveCount(1);
});
