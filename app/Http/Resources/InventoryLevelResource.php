<?php

namespace App\Http\Resources;

use App\Models\InventoryLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin InventoryLevel */
class InventoryLevelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'warehouse_id' => $this->warehouse_id,
            'variant_id' => $this->variant_id,
            'quantity_on_hand' => $this->quantity_on_hand,
            'quantity_reserved' => $this->quantity_reserved,
            'quantity_available' => $this->quantity_available,
            'low_stock_threshold' => $this->low_stock_threshold,
            'is_low_stock' => $this->is_low_stock,
            'bin_location' => $this->bin_location,
            'warehouse' => new BrandResource($this->whenLoaded('warehouse')),
        ];
    }
}
