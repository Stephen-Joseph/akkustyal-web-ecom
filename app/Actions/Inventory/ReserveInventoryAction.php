<?php

namespace App\Actions\Inventory;

use App\Models\InventoryLevel;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReserveInventoryAction
{
    /**
     * Atomically reserve stock for a variant across the highest-priority warehouse
     * that has sufficient available quantity.
     *
     * Uses a row-level UPDATE with a WHERE guard to prevent over-reservation
     * without application-level locking.
     *
     * @throws ValidationException when insufficient stock is available
     */
    public function execute(ProductVariant $variant, int $quantity): InventoryLevel
    {
        return DB::transaction(function () use ($variant, $quantity): InventoryLevel {
            // Find the highest-priority warehouse with sufficient available stock
            $inventoryLevel = InventoryLevel::query()
                ->where('variant_id', $variant->id)
                ->whereRaw('(quantity_on_hand - quantity_reserved) >= ?', [$quantity])
                ->join('warehouses', 'warehouses.id', '=', 'inventory_levels.warehouse_id')
                ->where('warehouses.is_active', true)
                ->orderBy('warehouses.priority')
                ->lockForUpdate()
                ->first(['inventory_levels.*']);

            if (! $inventoryLevel) {
                throw ValidationException::withMessages([
                    'quantity' => ["Insufficient stock for SKU '{$variant->sku}'. Requested: {$quantity}."],
                ]);
            }

            // Atomic increment of quantity_reserved
            $inventoryLevel->increment('quantity_reserved', $quantity);

            return $inventoryLevel->fresh();
        });
    }
}
