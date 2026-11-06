<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UpdateProductAction
{
    /**
     * Update an existing product and sync its category associations.
     *
     * @param array{
     *   brand_id?: string|null,
     *   name?: string,
     *   slug?: string,
     *   product_type?: string,
     *   status?: string,
     *   short_description?: string|null,
     *   description?: string|null,
     *   base_attributes?: array<string, mixed>,
     *   seo_metadata?: array<string, mixed>,
     *   published_at?: string|null,
     *   category_ids?: list<string>|null,
     *   primary_category_id?: string|null
     * } $data
     */
    public function execute(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data): Product {
            $product->update(array_filter([
                'brand_id' => $data['brand_id'] ?? $product->brand_id,
                'name' => $data['name'] ?? $product->name,
                'slug' => $data['slug'] ?? $product->slug,
                'product_type' => $data['product_type'] ?? $product->product_type,
                'status' => $data['status'] ?? $product->status,
                'short_description' => array_key_exists('short_description', $data) ? $data['short_description'] : $product->short_description,
                'description' => array_key_exists('description', $data) ? $data['description'] : $product->description,
                'base_attributes' => $data['base_attributes'] ?? $product->base_attributes,
                'seo_metadata' => $data['seo_metadata'] ?? $product->seo_metadata,
                'published_at' => array_key_exists('published_at', $data) ? $data['published_at'] : $product->published_at,
            ], fn ($value) => $value !== null || array_key_exists('short_description', $data) || array_key_exists('description', $data) || array_key_exists('published_at', $data)));

            // Keep nullable fields consistent — use direct update instead of array_filter
            $product->update([
                'brand_id' => $data['brand_id'] ?? $product->brand_id,
                'short_description' => array_key_exists('short_description', $data) ? $data['short_description'] : $product->short_description,
                'description' => array_key_exists('description', $data) ? $data['description'] : $product->description,
                'published_at' => array_key_exists('published_at', $data) ? $data['published_at'] : $product->published_at,
            ]);

            if (isset($data['category_ids'])) {
                $pivotData = [];
                $primaryCategoryId = $data['primary_category_id'] ?? null;

                foreach ($data['category_ids'] as $categoryId) {
                    $pivotData[$categoryId] = [
                        'is_primary' => $categoryId === $primaryCategoryId,
                        'sort_order' => 0,
                    ];
                }

                $product->categories()->sync($pivotData);
            }

            return $product->fresh(['brand', 'categories', 'variants']);
        });
    }
}
