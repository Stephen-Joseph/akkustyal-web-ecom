<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed Indian fashion category hierarchy into the categories table.
     */
    public function run(): void
    {
        $topLevel = [
            ['name' => "Men's", 'slug' => 'mens', 'path' => 'mens'],
            ['name' => "Women's", 'slug' => 'womens', 'path' => 'womens'],
            ['name' => "Kids'", 'slug' => 'kids', 'path' => 'kids'],
        ];

        foreach ($topLevel as $index => $data) {
            $parent = Category::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'depth' => 0,
                    'sort_order' => $index,
                    'is_active' => true,
                    'seo_metadata' => [],
                ])
            );

            $this->createSubcategories($parent);
        }
    }

    /**
     * Create subcategories for a given parent category.
     */
    private function createSubcategories(Category $parent): void
    {
        $subcategories = $this->getSubcategories($parent->slug);

        foreach ($subcategories as $index => $subData) {
            Category::updateOrCreate(
                ['slug' => $subData['slug']],
                [
                    'parent_id' => $parent->id,
                    'name' => $subData['name'],
                    'slug' => $subData['slug'],
                    'path' => $parent->path . '.' . str_replace('-', '_', $subData['slug']),
                    'depth' => 1,
                    'sort_order' => $index,
                    'is_active' => true,
                    'seo_metadata' => [],
                ]
            );
        }
    }

    /**
     * Return subcategory definitions for a given parent slug.
     *
     * @return array<int, array{name: string, slug: string}>
     */
    private function getSubcategories(string $parentSlug): array
    {
        return match ($parentSlug) {
            'mens' => [
                ['name' => 'Ethnic Wear', 'slug' => 'mens-ethnic-wear'],
                ['name' => 'Western Wear', 'slug' => 'mens-western-wear'],
                ['name' => 'Kurtas & Sherwanis', 'slug' => 'mens-kurtas-sherwanis'],
                ['name' => 'T-Shirts & Polos', 'slug' => 'mens-tshirts-polos'],
                ['name' => 'Trousers & Chinos', 'slug' => 'mens-trousers-chinos'],
            ],
            'womens' => [
                ['name' => 'Ethnic Wear', 'slug' => 'womens-ethnic-wear'],
                ['name' => 'Western Wear', 'slug' => 'womens-western-wear'],
                ['name' => 'Sarees', 'slug' => 'womens-sarees'],
                ['name' => 'Salwar Suits', 'slug' => 'womens-salwar-suits'],
                ['name' => 'Dresses & Tops', 'slug' => 'womens-dresses-tops'],
            ],
            'kids' => [
                ['name' => "Boys' Clothing", 'slug' => 'kids-boys-clothing'],
                ['name' => "Girls' Clothing", 'slug' => 'kids-girls-clothing'],
                ['name' => 'Ethnic Wear', 'slug' => 'kids-ethnic-wear'],
            ],
            default => [],
        };
    }
}
