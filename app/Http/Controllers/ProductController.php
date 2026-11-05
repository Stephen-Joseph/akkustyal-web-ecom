<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::with(['category', 'images', 'variants'])
            ->active()
            ->when($request->category, fn ($q) => $q->whereHas(
                'category',
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
            'category',
            'images',
            'variants',
            'reviews.customer',
        ])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::with(['images', 'variants'])
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('pages.product.view', compact('product', 'relatedProducts'));
    }
}
