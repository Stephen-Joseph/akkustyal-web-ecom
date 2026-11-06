<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Enums\ProductType;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'brand_id' => Brand::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'product_type' => ProductType::Simple,
            'status' => ProductStatus::Active,
            'short_description' => $this->faker->optional()->sentence(),
            'description' => $this->faker->paragraph(),
            'base_attributes' => [],
            'seo_metadata' => [],
            'published_at' => now(),
        ];
    }

    /**
     * Mark the product as a draft (unpublished).
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ProductStatus::Draft,
            'published_at' => null,
        ]);
    }

    /**
     * Mark the product as archived.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ProductStatus::Archived,
        ]);
    }

    /**
     * Mark the product as configurable (has variants with options).
     */
    public function configurable(): static
    {
        return $this->state(fn (array $attributes) => [
            'product_type' => ProductType::Configurable,
        ]);
    }
}
