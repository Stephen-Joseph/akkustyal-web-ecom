<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::with(['categories', 'brand', 'variants.prices', 'variants.inventoryLevels'])
            ->active()
            ->when($request->category, fn ($q) => $q->whereHas(
                'categories',
                fn ($c) => $c->where('slug', $request->category)
            ))
            ->when($request->search, fn ($q) => $q->where(
                'name',
                'ilike',
                '%'.$request->search.'%'
            ))
            ->paginate(24);

        return view('pages.products.view', compact('products'));
    }

    public function show(string $slug): View
    {
        $product = Product::with([
            'categories',
            'brand',
            'variants.prices',
            'variants.inventoryLevels',
            'reviews.customer',
        ])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        $primaryCategoryId = $product->categories->first()?->id;

        $relatedProducts = Product::with(['categories', 'variants.prices'])
            ->active()
            ->when(
                $primaryCategoryId,
                fn ($q) => $q->whereHas('categories', fn ($c) => $c->where('categories.id', $primaryCategoryId))
            )
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('pages.products.view', compact('product', 'relatedProducts'));
    }
}
