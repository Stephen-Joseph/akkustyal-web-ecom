<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * List all brands.
     */
    public function index(Request $request): JsonResponse
    {
        $brands = Brand::withTrashed()
            ->when($request->search, fn ($q) => $q->where('name', 'ilike', '%'.$request->search.'%'))
            ->when($request->boolean('active_only'), fn ($q) => $q->active())
            ->orderBy('name')
            ->paginate(25);

        return response()->json(BrandResource::collection($brands)->response()->getData(true));
    }

    /**
     * Create a new brand.
     */
    public function store(StoreBrandRequest $request): JsonResponse
    {
        $brand = Brand::create($request->validated());

        return response()->json(new BrandResource($brand), 201);
    }

    /**
     * Show a single brand.
     */
    public function show(Brand $brand): JsonResponse
    {
        return response()->json(new BrandResource($brand));
    }

    /**
     * Update a brand.
     */
    public function update(UpdateBrandRequest $request, Brand $brand): JsonResponse
    {
        $brand->update($request->validated());

        return response()->json(new BrandResource($brand));
    }

    /**
     * Soft-delete a brand.
     */
    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();

        return response()->json(null, 204);
    }
}
