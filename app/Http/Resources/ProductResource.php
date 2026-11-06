<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'product_type' => $this->product_type->value,
            'product_type_label' => $this->product_type->label(),
            'status' => $this->status->value,
            'status_label' => $this->status->label(),
            'short_description' => $this->short_description,
            'description' => $this->description,
            'base_attributes' => $this->base_attributes,
            'seo_metadata' => $this->seo_metadata,
            'primary_image' => $this->primary_image,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'variants' => ProductVariantResource::collection($this->whenLoaded('variants')),
        ];
    }
}
