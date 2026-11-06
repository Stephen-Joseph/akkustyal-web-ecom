<?php

namespace App\Actions\Inventory;

use App\Models\InventoryLevel;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class UpdateInventoryLevelAction
{
    /**
     * Set the on-hand and reserved quantities for a specific variant and warehouse.
     *
     * @param array{
     *   quantity_on_hand: int,
     *   quantity_reserved: int,
     *   low_stock_threshold?: int,
     *   bin_location?: string|null
     * } $data
     */
    public function execute(ProductVariant $variant, Warehouse $warehouse, array $data): InventoryLevel
    {
        return DB::transaction(function () use ($variant, $warehouse, $data): InventoryLevel {
            $inventoryLevel = InventoryLevel::updateOrCreate(
                [
                    'variant_id' => $variant->id,
                    'warehouse_id' => $warehouse->id,
                ],
                [
                    'quantity_on_hand' => $data['quantity_on_hand'],
                    'quantity_reserved' => $data['quantity_reserved'],
                    'low_stock_threshold' => $data['low_stock_threshold'] ?? 5,
                    'bin_location' => $data['bin_location'] ?? null,
                ]
            );

            return $inventoryLevel->fresh(['warehouse', 'variant']);
        });
    }
}
