<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariantTieredPrice extends Model
{
    use HasUuids;

    /** @var list<string> */
    protected $fillable = [
        'variant_id',
        'currency_code',
        'customer_group',
        'min_quantity',
        'max_quantity',
        'unit_price',
        'starts_at',
        'ends_at',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'min_quantity' => 'integer',
        'max_quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
