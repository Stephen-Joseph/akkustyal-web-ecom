<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'order_id',
        'payment_provider',
        'transaction_id',
        'amount',
        'status',
        'payment_method',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /** @param Builder<Payment> $query */
    public function scopeCompleted(Builder $query): void
    {
        $query->where('status', 'completed');
    }

    /** @param Builder<Payment> $query */
    public function scopeFailed(Builder $query): void
    {
        $query->where('status', 'failed');
    }
}
