<?php

namespace App\Http\Resources;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductVariant */
class ProductVariantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'is_default' => $this->is_default,
            'is_active' => $this->is_active,
            'track_inventory' => $this->track_inventory,
            'weight_grams' => $this->weight_grams,
            'length_mm' => $this->length_mm,
            'width_mm' => $this->width_mm,
            'height_mm' => $this->height_mm,
            'variant_options' => $this->variant_options,
            'technical_specs' => $this->technical_specs,
            'media_gallery' => $this->media_gallery,
            'primary_image' => $this->primary_image,
            'is_in_stock' => $this->is_in_stock,
            'total_available_stock' => $this->total_available_stock,
            'sort_order' => $this->sort_order,
            'prices' => VariantPriceResource::collection($this->whenLoaded('prices')),
            'inr_price' => new VariantPriceResource($this->whenLoaded('inrPrice')),
            'inventory_levels' => InventoryLevelResource::collection($this->whenLoaded('inventoryLevels')),
        ];
    }
}
