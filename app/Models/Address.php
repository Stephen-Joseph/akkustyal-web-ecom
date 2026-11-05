<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'customer_id',
        'address_type',
        'is_default',
        'street_line1',
        'street_line2',
        'city',
        'state',
        'postal_code',
        'country',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function shippingOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }

    public function billingOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'billing_address_id');
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /** @param Builder<Address> $query */
    public function scopeDefault(Builder $query): void
    {
        $query->where('is_default', true);
    }

    /** @param Builder<Address> $query */
    public function scopeShipping(Builder $query): void
    {
        $query->where('address_type', 'shipping');
    }

    /** @param Builder<Address> $query */
    public function scopeBilling(Builder $query): void
    {
        $query->where('address_type', 'billing');
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Returns a formatted single-line address string.
     */
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->street_line1,
            $this->street_line2,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country,
        ]);

        return implode(', ', $parts);
    }
}
