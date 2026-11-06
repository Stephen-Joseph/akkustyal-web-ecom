<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    public function definition(): array
    {
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL'];
        $colors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Navy', 'Beige'];
        $size = $this->faker->randomElement($sizes);
        $color = $this->faker->randomElement($colors);

        return [
            'product_id' => Product::factory(),
            'sku' => strtoupper(Str::random(8)),
            'barcode' => $this->faker->optional()->ean13(),
            'name' => "{$size} / {$color}",
            'is_default' => false,
            'is_active' => true,
            'track_inventory' => true,
            'weight_grams' => $this->faker->numberBetween(100, 2000),
            'length_mm' => $this->faker->numberBetween(100, 600),
            'width_mm' => $this->faker->numberBetween(100, 400),
            'height_mm' => $this->faker->numberBetween(10, 100),
            'variant_options' => ['size' => $size, 'color' => $color],
            'technical_specs' => [],
            'media_gallery' => [],
            'sort_order' => 0,
        ];
    }

    /**
     * Mark as the default variant for a product.
     */
    public function default(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_default' => true,
        ]);
    }

    /**
     * Mark the variant as inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
