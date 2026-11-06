<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Inventory\UpdateInventoryLevelAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInventoryLevelRequest;
use App\Http\Resources\InventoryLevelResource;
use App\Models\InventoryLevel;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        private readonly UpdateInventoryLevelAction $updateInventoryLevelAction,
    ) {}

    /**
     * List inventory levels for a specific warehouse or variant.
     */
    public function index(Request $request): JsonResponse
    {
        $levels = InventoryLevel::with(['warehouse', 'variant.product'])
            ->when($request->warehouse_id, fn ($q) => $q->where('warehouse_id', $request->warehouse_id))
            ->when($request->variant_id, fn ($q) => $q->where('variant_id', $request->variant_id))
            ->when($request->boolean('low_stock_only'), fn ($q) => $q->whereRaw('quantity_available <= low_stock_threshold'))
            ->paginate(50);

        return response()->json(InventoryLevelResource::collection($levels)->response()->getData(true));
    }

    /**
     * Show inventory levels for a specific variant across all warehouses.
     */
    public function showForVariant(ProductVariant $variant): JsonResponse
    {
        $levels = $variant->inventoryLevels()->with('warehouse')->get();

        return response()->json(InventoryLevelResource::collection($levels));
    }

    /**
     * Update the inventory level for a specific variant in a specific warehouse.
     */
    public function update(UpdateInventoryLevelRequest $request, ProductVariant $variant, Warehouse $warehouse): JsonResponse
    {
        $level = $this->updateInventoryLevelAction->execute($variant, $warehouse, $request->validated());

        return response()->json(new InventoryLevelResource($level));
    }

    /**
     * List all warehouses for selection in admin forms.
     */
    public function warehouses(Request $request): JsonResponse
    {
        $warehouses = Warehouse::when($request->boolean('active_only'), fn ($q) => $q->where('is_active', true))
            ->orderBy('priority')
            ->get();

        return response()->json($warehouses);
    }
}
