<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class DeleteProductImageAction
{
    /**
     * Remove an image association from a product, automatically reassigning the primary
     * badge if needed, and cleaning up orphaned image files from disk.
     */
    public function execute(Product $product, ProductImage $productImage): void
    {
        if ($productImage->product_id !== $product->id) {
            throw new InvalidArgumentException('The provided image assignment does not belong to this product.');
        }

        DB::transaction(function () use ($product, $productImage): void {
            $imageId = $productImage->image_id;
            $wasPrimary = (bool) $productImage->is_primary;
            $variantId = $productImage->variant_id;

            // Delete junction assignment
            $productImage->delete();

            // If the deleted image was primary, auto-promote the next available image in order
            if ($wasPrimary) {
                if ($variantId) {
                    $nextPrimary = ProductImage::where('variant_id', $variantId)
                        ->orderBy('sort_order')
                        ->first();
                } else {
                    $nextPrimary = ProductImage::where('product_id', $product->id)
                        ->whereNull('variant_id')
                        ->orderBy('sort_order')
                        ->first();
                }

                $nextPrimary?->update(['is_primary' => true]);
            }

            // Cleanup master Image record and physical file if no other products/variants use it
            $hasRemainingUsages = ProductImage::where('image_id', $imageId)->exists();
            if (! $hasRemainingUsages) {
                $image = Image::find($imageId);
                if ($image) {
                    if ($image->storage_disk === 'public' && $image->file_path) {
                        Storage::disk('public')->delete($image->file_path);
                    }
                    $image->delete();
                }
            }
        });
    }
}
