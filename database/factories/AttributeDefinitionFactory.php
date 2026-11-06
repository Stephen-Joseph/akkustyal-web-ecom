<?php

namespace Database\Factories;

use App\Enums\AttributeType;
use App\Models\AttributeDefinition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<AttributeDefinition>
 */
class AttributeDefinitionFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'code' => Str::snake($name),
            'name' => ucwords($name),
            'data_type' => $this->faker->randomElement(AttributeType::cases()),
            'unit' => null,
            'allowed_values' => null,
            'is_variant_axis' => false,
            'is_filterable' => true,
            'is_searchable' => false,
            'is_required' => false,
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }

    /**
     * Mark as a variant axis attribute (e.g., size, color).
     */
    public function variantAxis(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_variant_axis' => true,
            'data_type' => AttributeType::Select,
        ]);
    }
}
