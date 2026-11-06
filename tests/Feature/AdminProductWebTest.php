<?php

declare(strict_types=1);

use App\Enums\ProductStatus;
use App\Enums\ProductType;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

function getTestAdmin(): Admin
{
    return Admin::firstOrCreate(
        ['email' => 'admin-test@example.com'],
        [
            'username' => 'testadmin',
            'name' => 'Test Admin',
            'password' => 'secret-password',
            'role' => 'admin',
        ]
    );
}

test('guest is redirected to admin login from catalog pages', function (string $route): void {
    $this->get($route)->assertRedirect(route('admin.login'));
})->with([
    '/admin/catalog',
    '/admin/products',
    '/admin/products/create',
]);

test('admin can access catalog hub overview page', function (): void {
    $admin = getTestAdmin();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.catalog.index'))
        ->assertOk()
        ->assertSee('Products &amp; Categories', false)
        ->assertSee('Catalog Management')
        ->assertSee(route('admin.products.index'))
        ->assertSee(route('admin.products.create'));
});

test('admin can access products list page', function (): void {
    $admin = getTestAdmin();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.index'))
        ->assertOk()
        ->assertSee('Products')
        ->assertSee('New Product');
});

test('admin can access product details, edit, and update', function (): void {
    $admin = getTestAdmin();
    $product = Product::first();

    if (! $product) {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create(['path' => 'womens', 'depth' => 0]);
        $product = Product::create([
            'brand_id' => $brand->id,
            'name' => 'Web Test Product',
            'slug' => 'web-test-product',
            'product_type' => ProductType::Simple,
            'status' => ProductStatus::Active,
        ]);
    }

    // View product detail
    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.show', $product))
        ->assertOk()
        ->assertSee($product->name);

    // View product edit form
    $this->actingAs($admin, 'admin')
        ->get(route('admin.products.edit', $product))
        ->assertOk()
        ->assertSee($product->name);

    // Update product
    $this->actingAs($admin, 'admin')
        ->put(route('admin.products.update', $product), [
            'name' => 'Updated Product Name',
            'slug' => $product->slug,
            'product_type' => ProductType::Configurable->value,
            'status' => ProductStatus::Active->value,
            'short_description' => 'Updated short description.',
        ])
        ->assertRedirect(route('admin.products.show', $product))
        ->assertSessionHas('success');

    expect($product->fresh()->name)->toBe('Updated Product Name');
});
