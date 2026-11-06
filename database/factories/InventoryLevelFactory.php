<?php

namespace Database\Factories;

use App\Models\InventoryLevel;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InventoryLevel>
 */
class InventoryLevelFactory extends Factory
{
    public function definition(): array
    {
        $onHand = $this->faker->numberBetween(0, 200);
        $reserved = $this->faker->numberBetween(0, $onHand);

        return [
            'warehouse_id' => Warehouse::factory(),
            'variant_id' => ProductVariant::factory(),
            'quantity_on_hand' => $onHand,
            'quantity_reserved' => $reserved,
            'low_stock_threshold' => 5,
            'bin_location' => $this->faker->optional()->regexify('[A-Z]{2}-[0-9]{3}'),
        ];
    }

    /**
     * Create an inventory level with zero stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'quantity_on_hand' => 0,
            'quantity_reserved' => 0,
        ]);
    }

    /**
     * Create an inventory level at the low-stock threshold.
     */
    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'quantity_on_hand' => 5,
            'quantity_reserved' => 0,
            'low_stock_threshold' => 5,
        ]);
    }
}
