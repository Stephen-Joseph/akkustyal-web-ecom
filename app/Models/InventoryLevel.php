<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_levels';

    /** @var bool — composite PK, no auto-increment */
    public $incrementing = false;

    /** @var bool — no standard timestamps, only updated_at */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'warehouse_id',
        'variant_id',
        'quantity_on_hand',
        'quantity_reserved',
        'low_stock_threshold',
        'bin_location',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'quantity_on_hand' => 'integer',
        'quantity_reserved' => 'integer',
        'quantity_available' => 'integer',
        'low_stock_threshold' => 'integer',
        'updated_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Whether the current inventory level is at or below the low-stock threshold.
     */
    public function getIsLowStockAttribute(): bool
    {
        return $this->quantity_available <= $this->low_stock_threshold;
    }
}
