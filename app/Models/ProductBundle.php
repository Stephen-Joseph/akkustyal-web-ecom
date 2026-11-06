<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for the product_bundles table.
 *
 * @property string $parent_variant_id
 * @property string $child_variant_id
 * @property int    $quantity
 * @property string $revenue_allocation_pct
 * @property int    $sort_order
 * @property string $created_at
 */
class ProductBundle extends Pivot
{
    public const UPDATED_AT = null;

    /** @var string */
    protected $table = 'product_bundles';

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'parent_variant_id',
        'child_variant_id',
        'quantity',
        'revenue_allocation_pct',
        'sort_order',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'quantity' => 'integer',
        'revenue_allocation_pct' => 'decimal:2',
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
