<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProductStatus;
use App\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string|Enum>>
     */
    public function rules(): array
    {
        return [
            'brand_id' => ['nullable', 'uuid', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:280', 'unique:products,slug', 'regex:/^[a-z0-9\-]+$/'],
            'product_type' => ['required', new Enum(ProductType::class)],
            'status' => ['required', new Enum(ProductStatus::class)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'base_attributes' => ['nullable', 'array'],
            'seo_metadata' => ['nullable', 'array'],
            'seo_metadata.title' => ['nullable', 'string', 'max:160'],
            'seo_metadata.description' => ['nullable', 'string', 'max:320'],
            'published_at' => ['nullable', 'date'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['uuid', 'exists:categories,id'],
            'primary_category_id' => ['nullable', 'uuid', 'exists:categories,id'],
        ];
    }
}
