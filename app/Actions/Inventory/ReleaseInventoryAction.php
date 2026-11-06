<?php

namespace App\Actions\Inventory;

use App\Models\InventoryLevel;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class ReleaseInventoryAction
{
    /**
     * Release previously reserved inventory for a variant in a specific warehouse.
     * Used when an order is cancelled or payment fails.
     *
     * Clamps the decrement at zero to prevent negative reservations.
     */
    public function execute(ProductVariant $variant, int $quantity, Warehouse $warehouse): InventoryLevel
    {
        return DB::transaction(function () use ($variant, $quantity, $warehouse): InventoryLevel {
            $inventoryLevel = InventoryLevel::where('variant_id', $variant->id)
                ->where('warehouse_id', $warehouse->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Clamp: never release more than currently reserved
            $releaseQuantity = min($quantity, $inventoryLevel->quantity_reserved);

            if ($releaseQuantity > 0) {
                $inventoryLevel->decrement('quantity_reserved', $releaseQuantity);
            }

            return $inventoryLevel->fresh();
        });
    }
}
