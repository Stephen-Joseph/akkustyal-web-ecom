<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for the category_product table.
 *
 * @property string $category_id
 * @property string $product_id
 * @property bool   $is_primary
 * @property int    $sort_order
 * @property string $created_at
 */
class CategoryProduct extends Pivot
{
    public const UPDATED_AT = null;

    /** @var string */
    protected $table = 'category_product';

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'category_id',
        'product_id',
        'is_primary',
        'sort_order',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the name of the "updated at" column (null since table has only created_at).
     */
    public function getUpdatedAtColumn(): ?string
    {
        return null;
    }
}
