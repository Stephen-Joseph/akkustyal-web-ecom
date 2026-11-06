<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariantPrice extends Model
{
    use HasUuids;

    /** @var list<string> */
    protected $fillable = [
        'variant_id',
        'currency_code',
        'msrp_price',
        'retail_price',
        'cost_price',
        'sale_price',
        'sale_starts_at',
        'sale_ends_at',
        'tax_class',
        'is_tax_inclusive',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'msrp_price' => 'decimal:2',
        'retail_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'sale_starts_at' => 'datetime',
        'sale_ends_at' => 'datetime',
        'is_tax_inclusive' => 'boolean',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Returns the effective (currently active) price for this variant.
     * Applies sale price when within the sale window; falls back to retail price.
     */
    public function getEffectivePriceAttribute(): string
    {
        if (
            $this->sale_price !== null &&
            ($this->sale_starts_at === null || $this->sale_starts_at->lte(now())) &&
            ($this->sale_ends_at === null || $this->sale_ends_at->gte(now()))
        ) {
            return $this->sale_price;
        }

        return $this->retail_price;
    }

    /**
     * Returns whether the variant is currently on sale.
     */
    public function getIsOnSaleAttribute(): bool
    {
        return $this->sale_price !== null &&
            ($this->sale_starts_at === null || $this->sale_starts_at->lte(now())) &&
            ($this->sale_ends_at === null || $this->sale_ends_at->gte(now()));
    }
}
