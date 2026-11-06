<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Product\CreateProductVariantAction;
use App\Actions\Product\UpdateProductVariantAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductVariantRequest;
use App\Http\Requests\Admin\UpdateProductVariantRequest;
use App\Http\Resources\ProductVariantResource;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;

class ProductVariantController extends Controller
{
    public function __construct(
        private readonly CreateProductVariantAction $createVariantAction,
        private readonly UpdateProductVariantAction $updateVariantAction,
    ) {}

    /**
     * List all variants for a product.
     */
    public function index(Product $product): JsonResponse
    {
        $variants = $product->variants()
            ->with(['prices', 'inrPrice', 'inventoryLevels.warehouse'])
            ->withTrashed()
            ->orderBy('sort_order')
            ->get();

        return response()->json(ProductVariantResource::collection($variants));
    }

    /**
     * Create a new variant (SKU) for a product.
     */
    public function store(StoreProductVariantRequest $request, Product $product): JsonResponse
    {
        $variant = $this->createVariantAction->execute($product, $request->validated());

        return response()->json(new ProductVariantResource($variant), 201);
    }

    /**
     * Show a single variant.
     */
    public function show(Product $product, ProductVariant $variant): JsonResponse
    {
        $variant->load(['prices', 'inrPrice', 'inventoryLevels.warehouse', 'bundleComponents']);

        return response()->json(new ProductVariantResource($variant));
    }

    /**
     * Update a variant and its INR price.
     */
    public function update(UpdateProductVariantRequest $request, Product $product, ProductVariant $variant): JsonResponse
    {
        $variant = $this->updateVariantAction->execute($variant, $request->validated());

        return response()->json(new ProductVariantResource($variant));
    }

    /**
     * Soft-delete a variant.
     */
    public function destroy(Product $product, ProductVariant $variant): JsonResponse
    {
        $variant->delete();

        return response()->json(null, 204);
    }
}
