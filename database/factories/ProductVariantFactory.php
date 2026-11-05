<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 10, 500);

        return [
            'product_id' => Product::factory(),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-####-??')),
            'price' => $price,
            'compare_at_price' => $this->faker->optional(0.4)->randomFloat(2, $price + 5, $price + 100),
            'stock_quantity' => $this->faker->numberBetween(0, 200),
            'attributes' => [
                'size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
                'color' => $this->faker->colorName(),
            ],
        ];
    }

    /**
     * Mark variant as out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock_quantity' => 0,
        ]);
    }
}
