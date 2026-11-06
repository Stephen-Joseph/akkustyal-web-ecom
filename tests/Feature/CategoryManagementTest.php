<?php

use App\Models\Category;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create a root category with an ltree path', function (): void {
    $category = Category::create([
        'name' => "Men's",
        'slug' => 'mens',
        'path' => 'mens',
        'depth' => 0,
        'seo_metadata' => [],
        'is_active' => true,
    ]);

    expect($category->path)->toBe('mens')
        ->and($category->depth)->toBe(0)
        ->and($category->parent_id)->toBeNull();
});

it('can create a child category with correct depth and path', function (): void {
    $parent = Category::factory()->create([
        'slug' => 'mens',
        'path' => 'mens',
        'depth' => 0,
    ]);

    $child = Category::factory()->childOf($parent)->create([
        'name' => 'Ethnic Wear',
        'slug' => 'mens-ethnic-wear',
    ]);

    expect($child->depth)->toBe(1)
        ->and($child->parent_id)->toBe($parent->id)
        ->and((string) $child->path)->toStartWith('mens.');
});

it('prevents a category from being its own parent', function (): void {
    $category = Category::factory()->create();

    expect(fn () => $category->update(['parent_id' => $category->id]))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

it('scopes root categories correctly', function (): void {
    $root = Category::factory()->create(['path' => 'root_cat', 'depth' => 0]);
    $parent = Category::factory()->create(['path' => 'root_cat', 'depth' => 0]);
    Category::factory()->childOf($parent)->create();

    $roots = Category::roots()->get();

    expect($roots->pluck('id'))->toContain($root->id)
        ->and($roots->pluck('id'))->toContain($parent->id);
});
