<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'cart_id',
        'variant_id',
        'quantity',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'quantity' => 'integer',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Line total: variant price × quantity.
     */
    public function getLineTotalAttribute(): float
    {
        return (float) $this->variant->price * $this->quantity;
    }
}
