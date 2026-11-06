<?php

namespace App\Http\Resources;

use App\Models\VariantPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin VariantPrice */
class VariantPriceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'currency_code' => $this->currency_code,
            'msrp_price' => $this->msrp_price,
            'retail_price' => $this->retail_price,
            'cost_price' => $this->cost_price,
            'sale_price' => $this->sale_price,
            'effective_price' => $this->effective_price,
            'is_on_sale' => $this->is_on_sale,
            'sale_starts_at' => $this->sale_starts_at,
            'sale_ends_at' => $this->sale_ends_at,
            'tax_class' => $this->tax_class,
            'is_tax_inclusive' => $this->is_tax_inclusive,
        ];
    }
}
