<?php

namespace Database\Seeders;

use App\Enums\ImageRole;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Seed master DAM images and attach them to products & variants via product_images pivot.
     */
    public function run(): void
    {
        $mediaAssets = [
            'classic-cotton-kurta' => [
                [
                    'image' => [
                        'storage_disk' => 'public',
                        'image_name' => 'cotton-kurta-front.webp',
                        'original_filename' => 'cotton-kurta-front.jpg',
                        'file_path' => 'products/kurtas/cotton-kurta-front.webp',
                        'cdn_url' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=1200&q=80',
                        'mime_type' => 'image/webp',
                        'extension' => 'webp',
                        'file_size_bytes' => 145000,
                        'width_px' => 1200,
                        'height_px' => 1600,
                        'default_alt_text' => 'Classic Cotton Kurta front view',
                    ],
                    'pivot' => [
                        'is_primary' => true,
                        'image_role' => ImageRole::Thumbnail,
                        'sort_order' => 1,
                    ],
                ],
                [
                    'image' => [
                        'storage_disk' => 'public',
                        'image_name' => 'cotton-kurta-side.webp',
                        'original_filename' => 'cotton-kurta-side.jpg',
                        'file_path' => 'products/kurtas/cotton-kurta-side.webp',
                        'cdn_url' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=1200&q=80',
                        'mime_type' => 'image/webp',
                        'extension' => 'webp',
                        'file_size_bytes' => 138000,
                        'width_px' => 1200,
                        'height_px' => 1600,
                        'default_alt_text' => 'Classic Cotton Kurta side angle',
                    ],
                    'pivot' => [
                        'is_primary' => false,
                        'image_role' => ImageRole::Gallery,
                        'sort_order' => 2,
                    ],
                ],
            ],
            'royal-sherwani-set' => [
                [
                    'image' => [
                        'storage_disk' => 'public',
                        'image_name' => 'royal-sherwani-gold-front.webp',
                        'original_filename' => 'royal-sherwani-gold-front.jpg',
                        'file_path' => 'products/sherwanis/royal-sherwani-gold-front.webp',
                        'cdn_url' => 'https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp',
                        'mime_type' => 'image/webp',
                        'extension' => 'webp',
                        'file_size_bytes' => 182000,
                        'width_px' => 1080,
                        'height_px' => 1440,
                        'default_alt_text' => 'Royal Sherwani Set gold embroidery front',
                    ],
                    'pivot' => [
                        'is_primary' => true,
                        'image_role' => ImageRole::Thumbnail,
                        'sort_order' => 1,
                    ],
                ],
                [
                    'image' => [
                        'storage_disk' => 'public',
                        'image_name' => 'royal-sherwani-gold-detail.webp',
                        'original_filename' => 'royal-sherwani-gold-detail.jpg',
                        'file_path' => 'products/sherwanis/royal-sherwani-gold-detail.webp',
                        'cdn_url' => 'https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562',
                        'mime_type' => 'image/webp',
                        'extension' => 'webp',
                        'file_size_bytes' => 165000,
                        'width_px' => 1066,
                        'height_px' => 1420,
                        'default_alt_text' => 'Royal Sherwani fabric detail view',
                    ],
                    'pivot' => [
                        'is_primary' => false,
                        'image_role' => ImageRole::Gallery,
                        'sort_order' => 2,
                    ],
                ],
            ],
            'printed-anarkali-suit' => [
                [
                    'image' => [
                        'storage_disk' => 'public',
                        'image_name' => 'printed-anarkali-coral-front.webp',
                        'original_filename' => 'printed-anarkali-coral-front.jpg',
                        'file_path' => 'products/suits/printed-anarkali-coral-front.webp',
                        'cdn_url' => 'https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg',
                        'mime_type' => 'image/webp',
                        'extension' => 'webp',
                        'file_size_bytes' => 195000,
                        'width_px' => 1200,
                        'height_px' => 1600,
                        'default_alt_text' => 'Printed Anarkali Suit coral front view',
                    ],
                    'pivot' => [
                        'is_primary' => true,
                        'image_role' => ImageRole::Thumbnail,
                        'sort_order' => 1,
                    ],
                ],
            ],
        ];

        foreach ($mediaAssets as $slug => $assets) {
            $product = Product::with('variants')->where('slug', $slug)->first();
            if (! $product) {
                continue;
            }

            $defaultVariant = $product->variants->firstWhere('is_default', true) ?? $product->variants->first();

            foreach ($assets as $asset) {
                $image = Image::firstOrCreate(
                    ['cdn_url' => $asset['image']['cdn_url']],
                    $asset['image']
                );

                // Attach to base product via pivot if not already attached
                if (! $product->images()->where('image_id', $image->id)->exists()) {
                    $product->images()->attach($image->id, [
                        'image_name' => $asset['image']['image_name'],
                        'alt_text' => $asset['image']['default_alt_text'],
                        'image_role' => $asset['pivot']['image_role'],
                        'is_primary' => $asset['pivot']['is_primary'],
                        'sort_order' => $asset['pivot']['sort_order'],
                        'is_active' => true,
                    ]);
                }

                // If primary, also link to the default variant if variant exists
                if ($defaultVariant && ! $defaultVariant->images()->where('image_id', $image->id)->exists()) {
                    $defaultVariant->images()->attach($image->id, [
                        'product_id' => $product->id,
                        'image_name' => $asset['image']['image_name'],
                        'alt_text' => $asset['image']['default_alt_text'],
                        'image_role' => $asset['pivot']['image_role'],
                        'is_primary' => $asset['pivot']['is_primary'],
                        'sort_order' => $asset['pivot']['sort_order'],
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
