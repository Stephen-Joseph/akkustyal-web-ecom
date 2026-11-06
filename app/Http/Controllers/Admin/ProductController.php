<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Product\CreateProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly CreateProductAction $createProductAction,
        private readonly UpdateProductAction $updateProductAction,
    ) {}

    /**
     * List all products (admin view, includes drafts and archived).
     */
    public function index(Request $request): JsonResponse
    {
        $products = Product::with(['brand', 'categories'])
            ->when($request->status, fn ($q) => $q->withStatus($request->enum('status', \App\Enums\ProductStatus::class)))
            ->when($request->brand_id, fn ($q) => $q->where('brand_id', $request->brand_id))
            ->when($request->search, fn ($q) => $q->where('name', 'ilike', '%'.$request->search.'%'))
            ->latest()
            ->paginate(25);

        return response()->json(ProductResource::collection($products)->response()->getData(true));
    }

    /**
     * Create a new product.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->createProductAction->execute($request->validated());

        return response()->json(new ProductResource($product), 201);
    }

    /**
     * Show a single product with all relationships.
     */
    public function show(Product $product): JsonResponse
    {
        $product->load(['brand', 'categories', 'variants.prices', 'variants.inventoryLevels.warehouse']);

        return response()->json(new ProductResource($product));
    }

    /**
     * Update an existing product.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product = $this->updateProductAction->execute($product, $request->validated());

        return response()->json(new ProductResource($product));
    }

    /**
     * Soft-delete a product.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
