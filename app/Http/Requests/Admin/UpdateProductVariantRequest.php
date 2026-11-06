<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        $variantId = $this->route('variant')?->id;

        return [
            'sku' => ['sometimes', 'required', 'string', 'max:100', "unique:product_variants,sku,{$variantId}"],
            'barcode' => ['nullable', 'string', 'max:64'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'is_default' => ['boolean'],
            'is_active' => ['boolean'],
            'track_inventory' => ['boolean'],
            'weight_grams' => ['integer', 'min:0'],
            'length_mm' => ['integer', 'min:0'],
            'width_mm' => ['integer', 'min:0'],
            'height_mm' => ['integer', 'min:0'],
            'variant_options' => ['nullable', 'array'],
            'technical_specs' => ['nullable', 'array'],
            'media_gallery' => ['nullable', 'array'],
            'media_gallery.*.url' => ['required_with:media_gallery', 'url'],
            'media_gallery.*.alt' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'msrp_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'retail_price' => ['sometimes', 'required', 'numeric', 'min:0', 'lte:msrp_price'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'lt:retail_price'],
            'sale_starts_at' => ['nullable', 'date'],
            'sale_ends_at' => ['nullable', 'date', 'after:sale_starts_at'],
        ];
    }
}
