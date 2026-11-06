<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasUuids;

    /** @var list<string> */
    protected $fillable = [
        'code',
        'name',
        'country_code',
        'state_code',
        'postal_code',
        'address_details',
        'priority',
        'is_active',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'address_details' => 'array',
        'priority' => 'integer',
        'is_active' => 'boolean',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function inventoryLevels(): HasMany
    {
        return $this->hasMany(InventoryLevel::class, 'warehouse_id');
    }
}
