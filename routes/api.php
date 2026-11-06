<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('/login', LoginController::class)
        ->middleware('throttle:6,1')
        ->name('api.auth.login');
});

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/user', function (Request $request): UserResource {
        /** @var User $user */
        $user = $request->user();

        return new UserResource($user);
    })->name('api.user');
});

/*
|--------------------------------------------------------------------------
| Product Catalog & Inventory API Routes (v1)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->name('api.v1.')->group(function (): void {
    // Brands
    Route::apiResource('brands', BrandController::class);

    // Categories (Hierarchical with ltree)
    Route::get('categories/{category}/products', [CategoryController::class, 'products'])->name('categories.products');
    Route::apiResource('categories', CategoryController::class);

    // Products
    Route::apiResource('products', ProductController::class);

    // Product Variants (SKUs)
    Route::prefix('products/{product}')->name('products.')->group(function (): void {
        Route::apiResource('variants', ProductVariantController::class);
    });

    // Multi-Warehouse Inventory Engine
    Route::prefix('inventory')->name('inventory.')->group(function (): void {
        Route::get('/', [InventoryController::class, 'index'])->name('index');
        Route::get('/warehouses', [InventoryController::class, 'warehouses'])->name('warehouses');
        Route::get('/variants/{variant}', [InventoryController::class, 'showForVariant'])->name('variant');
        Route::put('/variants/{variant}/warehouses/{warehouse}', [InventoryController::class, 'update'])->name('update');
    });
});
