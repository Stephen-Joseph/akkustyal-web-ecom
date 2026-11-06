<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hero = HeroSection::where('section', 'home')->firstOrFail();

        $products = Product::query()
            ->with([
                'brand',
                'categories',
                'variants.prices',
                'variants.inventoryLevels',
            ])
            ->active()
            ->latest()
            ->get();

        $fallbackImages = [
            'https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp',
            'https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562',
            'https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg',
            'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=800&q=80',
        ];

        $productsJson = $products->map(function ($product, $index) use ($fallbackImages) {
            $firstVariant = $product->variants->first();
            $firstPrice = $firstVariant?->prices->first();
            $retailPrice = (float) ($firstPrice?->retail_price ?? 999);
            $msrpPrice = $firstPrice?->msrp_price ? (float) $firstPrice->msrp_price : null;

            $categoryName = $product->categories->first()?->name ?? 'Collection';
            $brandName = $product->brand?->name ?? 'AkkuStyle';

            $sizes = $product->variants->map(function ($v) {
                return $v->variant_options['size'] ?? $v->name;
            })->filter()->unique()->values()->all();

            if (empty($sizes)) {
                $sizes = ['S', 'M', 'L', 'XL'];
            }

            $color = $firstVariant?->variant_options['color'] ?? ($product->base_attributes['fabric'] ?? 'Standard');

            $images = ! empty($firstVariant?->media_gallery)
                ? $firstVariant->media_gallery
                : [$fallbackImages[$index % count($fallbackImages)]];

            $badge = null;
            if ($msrpPrice && $msrpPrice > $retailPrice) {
                $badge = round((($msrpPrice - $retailPrice) / $msrpPrice) * 100).'% OFF';
            } elseif ($product->created_at && $product->created_at->diffInDays(now()) < 14) {
                $badge = 'NEW';
            }

            return [
                'id' => (string) $product->id,
                'slug' => $product->slug,
                'title' => $product->name,
                'category' => $categoryName,
                'brand' => $brandName,
                'color' => is_array($color) ? implode(', ', $color) : (string) $color,
                'price' => $retailPrice,
                'oldPrice' => $msrpPrice,
                'badge' => $badge,
                'isNew' => $product->created_at && $product->created_at->diffInDays(now()) < 14,
                'isCollector' => false,
                'sizes' => $sizes,
                'modelNote' => 'Indian standard fit. Sourced from '.$brandName.'.',
                'description' => $product->description ?? $product->short_description ?? 'Premium crafted apparel.',
                'images' => $images,
                'url' => route('pages.products.show', $product->slug),
            ];
        })->values()->all();

        $categoriesList = array_values(array_unique(array_merge(
            ['All Products'],
            $products->flatMap->categories->pluck('name')->filter()->all()
        )));

        return view('index', compact('hero', 'products', 'productsJson', 'categoriesList'));
    }
}
