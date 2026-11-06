<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\VariantPrice;
use Illuminate\Support\Facades\DB;

class CreateProductAction
{
    /**
     * Create a new product with its category associations.
     *
     * @param array{
     *   brand_id: string|null,
     *   name: string,
     *   slug: string,
     *   product_type: string,
     *   status: string,
     *   short_description: string|null,
     *   description: string|null,
     *   base_attributes: array<string, mixed>,
     *   seo_metadata: array<string, mixed>,
     *   published_at: string|null,
     *   category_ids: list<string>|null,
     *   primary_category_id: string|null
     * } $data
     */
    public function execute(array $data): Product
    {
        return DB::transaction(function () use ($data): Product {
            $product = Product::create([
                'brand_id' => $data['brand_id'] ?? null,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'product_type' => $data['product_type'],
                'status' => $data['status'],
                'short_description' => $data['short_description'] ?? null,
                'description' => $data['description'] ?? null,
                'base_attributes' => $data['base_attributes'] ?? [],
                'seo_metadata' => $data['seo_metadata'] ?? [],
                'published_at' => $data['published_at'] ?? null,
            ]);

            if (! empty($data['category_ids'])) {
                $pivotData = [];

                foreach ($data['category_ids'] as $categoryId) {
                    $pivotData[$categoryId] = [
                        'is_primary' => $categoryId === ($data['primary_category_id'] ?? null),
                        'sort_order' => 0,
                    ];
                }

                $product->categories()->attach($pivotData);
            }

            return $product->load(['brand', 'categories']);
        });
    }
}
