<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'address_type' => $this->faker->randomElement(['shipping', 'billing']),
            'is_default' => false,
            'street_line1' => $this->faker->streetAddress(),
            'street_line2' => $this->faker->optional()->secondaryAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
        ];
    }

    public function shipping(): static
    {
        return $this->state(fn (array $attributes) => ['address_type' => 'shipping']);
    }

    public function billing(): static
    {
        return $this->state(fn (array $attributes) => ['address_type' => 'billing']);
    }

    public function asDefault(): static
    {
        return $this->state(fn (array $attributes) => ['is_default' => true]);
    }
}
