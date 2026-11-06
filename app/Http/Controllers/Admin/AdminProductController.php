<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Product\CreateProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Enums\ProductStatus;
use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    /**
     * List all products with search, status filtering, and pagination.
     */
    public function index(Request $request): View
    {
        $statusInput = $request->query('status');
        $statusEnum = $statusInput ? ProductStatus::tryFrom($statusInput) : null;

        $products = Product::query()
            ->with(['brand', 'categories', 'variants.prices'])
            ->when($statusEnum, fn ($q) => $q->where('status', $statusEnum))
            ->when($request->query('brand_id'), fn ($q, $brandId) => $q->where('brand_id', $brandId))
            ->when($request->query('search'), function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'ilike', "%{$search}%")
                        ->orWhere('slug', 'ilike', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $brands = Brand::orderBy('name')->get(['id', 'name']);
        $statuses = ProductStatus::cases();

        return view('admin.products.index', compact('products', 'brands', 'statuses'));
    }

    /**
     * Show form to create a new product.
     */
    public function create(): View
    {
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $statuses = ProductStatus::cases();
        $types = ProductType::cases();

        return view('admin.products.create', compact('brands', 'categories', 'statuses', 'types'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request, CreateProductAction $createProductAction): RedirectResponse
    {
        if (! $request->filled('slug') && $request->filled('name')) {
            $request->merge(['slug' => Str::slug($request->string('name')->value())]);
        }

        $validated = $request->validate([
            'brand_id' => ['nullable', 'uuid', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:280', 'unique:products,slug', 'regex:/^[a-z0-9\-]+$/'],
            'product_type' => ['required', new Enum(ProductType::class)],
            'status' => ['required', new Enum(ProductStatus::class)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['uuid', 'exists:categories,id'],
            'primary_category_id' => ['nullable', 'uuid', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
            'fabric' => ['nullable', 'string', 'max:100'],
            'occasion' => ['nullable', 'string', 'max:100'],
        ]);

        $baseAttributes = [];
        if (! empty($validated['fabric'])) {
            $baseAttributes['fabric'] = $validated['fabric'];
        }
        if (! empty($validated['occasion'])) {
            $baseAttributes['occasion'] = array_map('trim', explode(',', $validated['occasion']));
        }
        $validated['base_attributes'] = $baseAttributes;

        $product = $createProductAction->execute($validated);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', "Product \"{$product->name}\" created successfully.");
    }

    /**
     * Display a single product's full view details (variants, prices, attributes).
     */
    public function show(Product $product): View
    {
        $product->load([
            'brand',
            'categories',
            'variants.prices',
            'variants.inventoryLevels.warehouse',
        ]);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show form to edit an existing product.
     */
    public function edit(Product $product): View
    {
        $product->load(['brand', 'categories']);
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $statuses = ProductStatus::cases();
        $types = ProductType::cases();

        return view('admin.products.edit', compact('product', 'brands', 'categories', 'statuses', 'types'));
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, Product $product, UpdateProductAction $updateProductAction): RedirectResponse
    {
        if (! $request->filled('slug') && $request->filled('name')) {
            $request->merge(['slug' => Str::slug($request->string('name')->value())]);
        }

        $validated = $request->validate([
            'brand_id' => ['nullable', 'uuid', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:280', "unique:products,slug,{$product->id}", 'regex:/^[a-z0-9\-]+$/'],
            'product_type' => ['required', new Enum(ProductType::class)],
            'status' => ['required', new Enum(ProductStatus::class)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['uuid', 'exists:categories,id'],
            'primary_category_id' => ['nullable', 'uuid', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
            'fabric' => ['nullable', 'string', 'max:100'],
            'occasion' => ['nullable', 'string', 'max:100'],
        ]);

        $baseAttributes = $product->base_attributes ?? [];
        if ($request->has('fabric')) {
            $baseAttributes['fabric'] = $validated['fabric'] ?: null;
        }
        if ($request->has('occasion')) {
            $baseAttributes['occasion'] = $validated['occasion']
                ? array_map('trim', explode(',', $validated['occasion']))
                : null;
        }
        $validated['base_attributes'] = array_filter($baseAttributes);

        $updateProductAction->execute($product, $validated);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', "Product \"{$product->name}\" updated successfully.");
    }

    /**
     * Soft-delete a product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$name}\" was successfully deleted.");
    }
}
