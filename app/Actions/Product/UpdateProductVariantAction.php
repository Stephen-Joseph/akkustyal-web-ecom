<?php

namespace App\Actions\Product;

use App\Models\ProductVariant;
use App\Models\VariantPrice;
use Illuminate\Support\Facades\DB;

class UpdateProductVariantAction
{
    /**
     * Update an existing SKU variant and optionally update its INR price.
     *
     * @param array{
     *   sku?: string,
     *   barcode?: string|null,
     *   name?: string,
     *   is_default?: bool,
     *   is_active?: bool,
     *   track_inventory?: bool,
     *   weight_grams?: int,
     *   length_mm?: int,
     *   width_mm?: int,
     *   height_mm?: int,
     *   variant_options?: array<string, mixed>,
     *   technical_specs?: array<string, mixed>,
     *   media_gallery?: list<array{url: string, alt: string|null}>,
     *   sort_order?: int,
     *   msrp_price?: float,
     *   retail_price?: float,
     *   cost_price?: float|null,
     *   sale_price?: float|null,
     *   sale_starts_at?: string|null,
     *   sale_ends_at?: string|null
     * } $data
     */
    public function execute(ProductVariant $variant, array $data): ProductVariant
    {
        return DB::transaction(function () use ($variant, $data): ProductVariant {
            // If setting as default, clear other defaults for this product
            if (! empty($data['is_default'])) {
                $variant->product->variants()
                    ->where('id', '!=', $variant->id)
                    ->update(['is_default' => false]);
            }

            $variant->update(array_intersect_key($data, array_flip([
                'sku', 'barcode', 'name', 'is_default', 'is_active', 'track_inventory',
                'weight_grams', 'length_mm', 'width_mm', 'height_mm',
                'variant_options', 'technical_specs', 'media_gallery', 'sort_order',
            ])));

            // Update INR price if any price field is provided
            $priceKeys = ['msrp_price', 'retail_price', 'cost_price', 'sale_price', 'sale_starts_at', 'sale_ends_at'];
            $priceData = array_intersect_key($data, array_flip($priceKeys));

            if (! empty($priceData)) {
                VariantPrice::updateOrCreate(
                    ['variant_id' => $variant->id, 'currency_code' => 'INR'],
                    $priceData
                );
            }

            return $variant->fresh(['prices', 'inrPrice', 'inventoryLevels']);
        });
    }
}
