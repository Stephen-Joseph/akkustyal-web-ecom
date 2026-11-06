<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        return [
            'parent_id' => ['nullable', 'uuid', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:180', 'unique:categories,slug', 'regex:/^[a-z0-9\-]+$/'],
            'description' => ['nullable', 'string', 'max:5000'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'seo_metadata' => ['nullable', 'array'],
            'seo_metadata.title' => ['nullable', 'string', 'max:160'],
            'seo_metadata.description' => ['nullable', 'string', 'max:320'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}
