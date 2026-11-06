<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\View\View;

class CatalogHubController extends Controller
{
    public function index(): View
    {
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'brands_count' => Brand::count(),
            'variants_count' => ProductVariant::count(),
        ];

        return view('admin.catalog.index', compact('stats'));
    }
}
