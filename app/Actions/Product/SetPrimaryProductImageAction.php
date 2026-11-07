<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class SetPrimaryProductImageAction
{
    /**
     * Mark a specific product image as the primary image for the product or variant,
     * safely demoting existing primaries to satisfy PostgreSQL unique constraints.
     */
    public function execute(Product $product, ProductImage $productImage): ProductImage
    {
        if ($productImage->product_id !== $product->id) {
            throw new InvalidArgumentException('The provided image assignment does not belong to this product.');
        }

        return DB::transaction(function () use ($product, $productImage): ProductImage {
            if ($productImage->variant_id) {
                ProductImage::where('variant_id', $productImage->variant_id)
                    ->where('id', '!=', $productImage->id)
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            } else {
                ProductImage::where('product_id', $product->id)
                    ->whereNull('variant_id')
                    ->where('id', '!=', $productImage->id)
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            }

            $productImage->update(['is_primary' => true]);

            return $productImage->fresh(['image', 'product', 'variant']);
        });
    }
}
