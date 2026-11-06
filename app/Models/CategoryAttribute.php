<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for the category_attributes table.
 *
 * @property string $category_id
 * @property string $attribute_id
 * @property bool   $is_required_in_category
 * @property int    $sort_order
 */
class CategoryAttribute extends Pivot
{
    /** @var string */
    protected $table = 'category_attributes';

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'category_id',
        'attribute_id',
        'is_required_in_category',
        'sort_order',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'is_required_in_category' => 'boolean',
        'sort_order' => 'integer',
    ];
}
