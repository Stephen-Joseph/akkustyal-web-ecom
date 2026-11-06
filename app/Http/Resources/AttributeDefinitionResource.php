<?php

namespace App\Http\Resources;

use App\Models\AttributeDefinition;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AttributeDefinition */
class AttributeDefinitionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'data_type' => $this->data_type->value,
            'unit' => $this->unit,
            'allowed_values' => $this->allowed_values,
            'is_variant_axis' => $this->is_variant_axis,
            'is_filterable' => $this->is_filterable,
            'is_searchable' => $this->is_searchable,
            'is_required' => $this->is_required,
            'sort_order' => $this->sort_order,
        ];
    }
}
