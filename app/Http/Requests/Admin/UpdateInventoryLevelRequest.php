<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryLevelRequest extends FormRequest
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
            'quantity_on_hand' => ['required', 'integer', 'min:0'],
            'quantity_reserved' => ['required', 'integer', 'min:0', 'lte:quantity_on_hand'],
            'low_stock_threshold' => ['integer', 'min:0'],
            'bin_location' => ['nullable', 'string', 'max:64'],
        ];
    }
}
