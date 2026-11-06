<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Warehouse>
 */
class WarehouseFactory extends Factory
{
    public function definition(): array
    {
        $cities = [
            ['code' => 'MUM', 'name' => 'Mumbai', 'state' => 'MH', 'postal' => '400001'],
            ['code' => 'DEL', 'name' => 'Delhi', 'state' => 'DL', 'postal' => '110001'],
            ['code' => 'BLR', 'name' => 'Bangalore', 'state' => 'KA', 'postal' => '560001'],
        ];

        $city = $this->faker->unique()->randomElement($cities);
        $suffix = $this->faker->numberBetween(1, 9);

        return [
            'code' => "{$city['code']}-WH{$suffix}",
            'name' => "{$city['name']} Warehouse {$suffix}",
            'country_code' => 'IN',
            'state_code' => $city['state'],
            'postal_code' => $city['postal'],
            'address_details' => [
                'city' => $city['name'],
                'street' => $this->faker->streetAddress(),
            ],
            'priority' => $this->faker->numberBetween(1, 200),
            'is_active' => true,
        ];
    }

    /**
     * Mark the warehouse as inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
