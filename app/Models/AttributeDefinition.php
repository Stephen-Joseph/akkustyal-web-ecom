<?php

namespace App\Models;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AttributeDefinition extends Model
{
    use HasUuids;

    /** @var list<string> */
    protected $fillable = [
        'code',
        'name',
        'data_type',
        'unit',
        'allowed_values',
        'is_variant_axis',
        'is_filterable',
        'is_searchable',
        'is_required',
        'sort_order',
    ];

    /** @var array<string, string|class-string> */
    protected $casts = [
        'data_type' => AttributeType::class,
        'allowed_values' => 'array',
        'is_variant_axis' => 'boolean',
        'is_filterable' => 'boolean',
        'is_searchable' => 'boolean',
        'is_required' => 'boolean',
        'sort_order' => 'integer',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_attributes', 'attribute_id', 'category_id')
            ->withPivot(['is_required_in_category', 'sort_order']);
    }
}
