<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantPrice;
use Illuminate\Support\Facades\DB;

class CreateProductVariantAction
{
    /**
     * Create a new SKU variant for a product, with an INR price entry.
     *
     * @param array{
     *   sku: string,
     *   barcode: string|null,
     *   name: string,
     *   is_default: bool,
     *   is_active: bool,
     *   track_inventory: bool,
     *   weight_grams: int,
     *   length_mm: int,
     *   width_mm: int,
     *   height_mm: int,
     *   variant_options: array<string, mixed>,
     *   technical_specs: array<string, mixed>,
     *   media_gallery: list<array{url: string, alt: string|null}>,
     *   sort_order: int,
     *   msrp_price: float,
     *   retail_price: float,
     *   cost_price: float|null,
     *   sale_price: float|null,
     *   sale_starts_at: string|null,
     *   sale_ends_at: string|null
     * } $data
     */
    public function execute(Product $product, array $data): ProductVariant
    {
        return DB::transaction(function () use ($product, $data): ProductVariant {
            // If this is marked default, clear other defaults first
            if ($data['is_default'] ?? false) {
                $product->variants()->update(['is_default' => false]);
            }

            $variant = $product->variants()->create([
                'sku' => $data['sku'],
                'barcode' => $data['barcode'] ?? null,
                'name' => $data['name'],
                'is_default' => $data['is_default'] ?? false,
                'is_active' => $data['is_active'] ?? true,
                'track_inventory' => $data['track_inventory'] ?? true,
                'weight_grams' => $data['weight_grams'] ?? 0,
                'length_mm' => $data['length_mm'] ?? 0,
                'width_mm' => $data['width_mm'] ?? 0,
                'height_mm' => $data['height_mm'] ?? 0,
                'variant_options' => $data['variant_options'] ?? [],
                'technical_specs' => $data['technical_specs'] ?? [],
                'media_gallery' => $data['media_gallery'] ?? [],
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            // Create the INR price record
            VariantPrice::create([
                'variant_id' => $variant->id,
                'currency_code' => 'INR',
                'msrp_price' => $data['msrp_price'],
                'retail_price' => $data['retail_price'],
                'cost_price' => $data['cost_price'] ?? null,
                'sale_price' => $data['sale_price'] ?? null,
                'sale_starts_at' => $data['sale_starts_at'] ?? null,
                'sale_ends_at' => $data['sale_ends_at'] ?? null,
                'tax_class' => 'standard',
                'is_tax_inclusive' => true,
            ]);

            return $variant->load(['prices', 'inrPrice']);
        });
    }
}
