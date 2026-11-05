<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'order_id',
        'variant_id',
        'quantity',
        'price_at_purchase',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'quantity' => 'integer',
        'price_at_purchase' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Line total at the time of purchase.
     */
    public function getLineTotalAttribute(): float
    {
        return (float) $this->price_at_purchase * $this->quantity;
    }
}
