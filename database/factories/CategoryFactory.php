<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'parent_id' => null,
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'path' => Str::slug($name, '_'),
            'depth' => 0,
            'description' => $this->faker->optional()->sentence(),
            'image_url' => $this->faker->optional()->imageUrl(400, 300, 'fashion'),
            'seo_metadata' => [],
            'sort_order' => $this->faker->numberBetween(0, 100),
            'is_active' => true,
        ];
    }

    /**
     * Create a category as a child of the given parent.
     */
    public function childOf(Category $parent): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parent->id,
            'depth' => $parent->depth + 1,
            'path' => $parent->path . '.' . Str::slug($attributes['name'] ?? $this->faker->word(), '_'),
        ]);
    }

    /**
     * Mark the category as inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
