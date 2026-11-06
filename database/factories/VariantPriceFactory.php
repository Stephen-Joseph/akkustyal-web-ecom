<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\VariantPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VariantPrice>
 */
class VariantPriceFactory extends Factory
{
    public function definition(): array
    {
        // Ensure msrp >= retail and sale < retail (all constraints satisfied)
        $msrp = $this->faker->numberBetween(500, 10000);
        $retail = $this->faker->numberBetween(400, $msrp);

        return [
            'variant_id' => ProductVariant::factory(),
            'currency_code' => 'INR',
            'msrp_price' => $msrp,
            'retail_price' => $retail,
            'cost_price' => $this->faker->optional()->numberBetween(100, $retail),
            'sale_price' => null,
            'sale_starts_at' => null,
            'sale_ends_at' => null,
            'tax_class' => 'standard',
            'is_tax_inclusive' => true,
        ];
    }

    /**
     * Create a price entry with an active sale.
     */
    public function onSale(): static
    {
        return $this->state(function (array $attributes) {
            $retail = $attributes['retail_price'];
            $salePrice = $this->faker->numberBetween(100, (int) $retail - 1);

            return [
                'sale_price' => $salePrice,
                'sale_starts_at' => now()->subDay(),
                'sale_ends_at' => now()->addDays(7),
            ];
        });
    }
}
