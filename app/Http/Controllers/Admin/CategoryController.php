<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * List the category tree (root categories with eager-loaded children).
     */
    public function index(Request $request): JsonResponse
    {
        $categories = Category::with('children.children')
            ->roots()
            ->when($request->boolean('active_only'), fn ($q) => $q->active())
            ->orderBy('sort_order')
            ->get();

        return response()->json(CategoryResource::collection($categories));
    }

    /**
     * Create a new category.
     * Automatically computes depth and ltree path from the parent.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        /** @var Category|null $parent */
        $parent = isset($data['parent_id'])
            ? Category::findOrFail($data['parent_id'])
            : null;

        $data['depth'] = $parent ? $parent->depth + 1 : 0;
        $data['path'] = $parent
            ? $parent->path.'.'.Str::slug($data['slug'], '_')
            : Str::slug($data['slug'], '_');

        $category = Category::create($data);

        return response()->json(new CategoryResource($category), 201);
    }

    /**
     * Show a single category with its children.
     */
    public function show(Category $category): JsonResponse
    {
        $category->load('children', 'attributes', 'parent');

        return response()->json(new CategoryResource($category));
    }

    /**
     * Update a category.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = $request->validated();

        // Recompute path if slug or parent changes
        if (isset($data['slug']) || isset($data['parent_id'])) {
            $slug = $data['slug'] ?? $category->slug;
            $parentId = array_key_exists('parent_id', $data) ? $data['parent_id'] : $category->parent_id;

            $parent = $parentId ? Category::find($parentId) : null;
            $data['depth'] = $parent ? $parent->depth + 1 : 0;
            $data['path'] = $parent
                ? $parent->path.'.'.Str::slug($slug, '_')
                : Str::slug($slug, '_');
        }

        $category->update($data);

        return response()->json(new CategoryResource($category));
    }

    /**
     * Delete a category (restricted if it has children or products).
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(null, 204);
    }

    /**
     * Return all products for a category and its descendants using the ltree index.
     */
    public function products(Request $request, Category $category): JsonResponse
    {
        $products = \App\Models\Product::with(['brand', 'categories'])
            ->active()
            ->whereHas('categories', function ($q) use ($category): void {
                $q->descendantsOf($category->path);
            })
            ->paginate(25);

        return response()->json(\App\Http\Resources\ProductResource::collection($products)->response()->getData(true));
    }
}
