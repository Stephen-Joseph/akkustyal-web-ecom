<?php

use App\Models\Brand;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create a brand', function (): void {
    $data = [
        'name' => 'Fabindia',
        'slug' => 'fabindia',
        'is_active' => true,
    ];

    $brand = Brand::create($data);

    expect($brand)->toBeInstanceOf(Brand::class)
        ->and($brand->name)->toBe('Fabindia')
        ->and($brand->slug)->toBe('fabindia')
        ->and($brand->is_active)->toBeTrue();
});

it('can soft delete a brand', function (): void {
    $brand = Brand::factory()->create();

    $brand->delete();

    expect(Brand::find($brand->id))->toBeNull()
        ->and(Brand::withTrashed()->find($brand->id))->not->toBeNull();
});

it('scopes to active brands only', function (): void {
    Brand::factory()->create(['is_active' => true]);
    Brand::factory()->inactive()->create();

    $activeBrands = Brand::active()->get();

    expect($activeBrands)->toHaveCount(1)
        ->and($activeBrands->first()->is_active)->toBeTrue();
});

it('enforces unique slug constraint', function (): void {
    Brand::factory()->create(['slug' => 'duplicate-slug']);

    expect(fn () => Brand::factory()->create(['slug' => 'duplicate-slug']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});
