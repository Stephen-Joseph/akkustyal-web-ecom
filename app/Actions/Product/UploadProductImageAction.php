<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Enums\ImageRole;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class UploadProductImageAction
{
    /**
     * Upload a physical image file or register an external CDN URL and attach it to a product.
     *
     * @param array{
     *   image_role?: ImageRole|string|null,
     *   alt_text?: string|null,
     *   caption?: string|null,
     *   is_primary?: bool|null,
     *   sort_order?: int|null,
     *   variant_id?: string|null,
     *   cdn_url?: string|null,
     *   option_match?: array<string, mixed>|null
     * } $data
     */
    public function execute(Product $product, array $data, ?UploadedFile $file = null): ProductImage
    {
        if (! $file && empty($data['cdn_url'])) {
            throw new InvalidArgumentException('Either an uploaded image file or a valid CDN URL is required.');
        }

        return DB::transaction(function () use ($product, $data, $file): ProductImage {
            $variantId = ! empty($data['variant_id']) ? $data['variant_id'] : null;

            // Resolve ImageRole
            $roleInput = $data['image_role'] ?? ImageRole::Gallery;
            $imageRole = $roleInput instanceof ImageRole
                ? $roleInput
                : (ImageRole::tryFrom((string) $roleInput) ?? ImageRole::Gallery);

            // Alt text fallback to product name
            $altText = ! empty($data['alt_text'])
                ? trim($data['alt_text'])
                : $product->name;

            // Sort order calculation
            $sortOrder = isset($data['sort_order'])
                ? (int) $data['sort_order']
                : (((int) ProductImage::where('product_id', $product->id)->max('sort_order')) + 1);

            // Determine if image should be primary
            if (isset($data['is_primary'])) {
                $isPrimary = (bool) $data['is_primary'];
            } else {
                // If this is the first image attached at this scope, default to primary
                $hasExistingPrimary = $variantId
                    ? ProductImage::where('variant_id', $variantId)->where('is_primary', true)->exists()
                    : ProductImage::where('product_id', $product->id)->whereNull('variant_id')->where('is_primary', true)->exists();

                $isPrimary = ! $hasExistingPrimary;
            }

            // Create Master Image Record
            if ($file) {
                $originalFilename = $file->getClientOriginalName();
                $cleanName = pathinfo($originalFilename, PATHINFO_FILENAME);
                $extension = strtolower($file->getClientOriginalExtension() ?: 'webp');
                $mimeType = $file->getMimeType() ?: 'image/webp';
                $fileSizeBytes = $file->getSize();

                // Compute dimensions safely
                $width = null;
                $height = null;
                $realPath = $file->getRealPath();
                if ($realPath && file_exists($realPath)) {
                    $dimensions = @getimagesize($realPath);
                    if ($dimensions) {
                        $width = $dimensions[0];
                        $height = $dimensions[1];
                    }
                }

                // Store file on public disk
                $storedPath = $file->store("products/{$product->id}", 'public');
                $cdnUrl = Storage::disk('public')->url($storedPath);

                $image = Image::create([
                    'storage_disk' => 'public',
                    'image_name' => $cleanName,
                    'original_filename' => $originalFilename,
                    'file_path' => $storedPath,
                    'cdn_url' => $cdnUrl,
                    'mime_type' => $mimeType,
                    'extension' => $extension,
                    'file_size_bytes' => max(0, $fileSizeBytes),
                    'width_px' => $width,
                    'height_px' => $height,
                    'default_alt_text' => $altText,
                ]);
            } else {
                $cdnUrl = trim((string) $data['cdn_url']);
                $parsedPath = parse_url($cdnUrl, PHP_URL_PATH);
                $urlFilename = $parsedPath ? basename($parsedPath) : 'image.webp';
                $cleanName = pathinfo($urlFilename, PATHINFO_FILENAME) ?: Str::slug($product->name);
                $extension = strtolower(pathinfo($urlFilename, PATHINFO_EXTENSION) ?: 'webp');

                $image = Image::create([
                    'storage_disk' => 'external',
                    'image_name' => $cleanName,
                    'original_filename' => $urlFilename,
                    'file_path' => $cdnUrl,
                    'cdn_url' => $cdnUrl,
                    'mime_type' => 'image/'.$extension,
                    'extension' => $extension,
                    'file_size_bytes' => 0,
                    'width_px' => null,
                    'height_px' => null,
                    'default_alt_text' => $altText,
                ]);
            }

            // Enforce PostgreSQL partial unique index: only 1 primary per scope
            if ($isPrimary) {
                if ($variantId) {
                    ProductImage::where('variant_id', $variantId)
                        ->where('is_primary', true)
                        ->update(['is_primary' => false]);
                } else {
                    ProductImage::where('product_id', $product->id)
                        ->whereNull('variant_id')
                        ->where('is_primary', true)
                        ->update(['is_primary' => false]);
                }
            }

            // Attach to product_images pivot
            return ProductImage::create([
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'image_id' => $image->id,
                'image_name' => $image->image_name,
                'alt_text' => $altText,
                'caption' => $data['caption'] ?? null,
                'image_role' => $imageRole,
                'option_match' => $data['option_match'] ?? null,
                'is_primary' => $isPrimary,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ])->load(['image', 'product', 'variant']);
        });
    }
}
