<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasUuids, SoftDeletes;

    /** @var list<string> */
    protected $fillable = [
        'product_id',
        'sku',
        'barcode',
        'name',
        'is_default',
        'is_active',
        'track_inventory',
        'weight_grams',
        'length_mm',
        'width_mm',
        'height_mm',
        'variant_options',
        'technical_specs',
        'media_gallery',
        'sort_order',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'track_inventory' => 'boolean',
        'weight_grams' => 'integer',
        'length_mm' => 'integer',
        'width_mm' => 'integer',
        'height_mm' => 'integer',
        'variant_options' => 'array',
        'technical_specs' => 'array',
        'media_gallery' => 'array',
        'sort_order' => 'integer',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(VariantPrice::class, 'variant_id');
    }

    /**
     * The INR price record for this variant (most common access pattern).
     */
    public function inrPrice(): HasOne
    {
        return $this->hasOne(VariantPrice::class, 'variant_id')->where('currency_code', 'INR');
    }

    public function tieredPrices(): HasMany
    {
        return $this->hasMany(VariantTieredPrice::class, 'variant_id');
    }

    public function inventoryLevels(): HasMany
    {
        return $this->hasMany(InventoryLevel::class, 'variant_id');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'variant_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'variant_id');
    }

    /**
     * Products for which this variant is a child component in a bundle.
     */
    public function parentBundles(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'product_bundles', 'child_variant_id', 'parent_variant_id')
            ->using(ProductBundle::class)
            ->withPivot(['quantity', 'revenue_allocation_pct', 'sort_order']);
    }

    /**
     * Child component variants that make up this bundle variant.
     */
    public function bundleComponents(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'product_bundles', 'parent_variant_id', 'child_variant_id')
            ->using(ProductBundle::class)
            ->withPivot(['quantity', 'revenue_allocation_pct', 'sort_order'])
            ->orderByPivot('sort_order');
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /** @param Builder<ProductVariant> $query */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope to filter variants by JSONB variant_options containment.
     * Uses the GIN (jsonb_path_ops) index for high-speed faceted filtering.
     *
     * @param Builder<ProductVariant>  $query
     * @param array<string, mixed> $options
     */
    public function scopeWithVariantOptions(Builder $query, array $options): void
    {
        $query->whereRaw('variant_options @> ?::jsonb', [json_encode($options)]);
    }

    /**
     * Scope to include only variants that have available stock across any warehouse.
     *
     * @param Builder<ProductVariant> $query
     */
    public function scopeInStock(Builder $query): void
    {
        $query->whereHas('inventoryLevels', function (Builder $q): void {
            $q->where('quantity_available', '>', 0);
        });
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Returns the total quantity available across all warehouses.
     */
    public function getTotalAvailableStockAttribute(): int
    {
        return (int) $this->inventoryLevels->sum('quantity_available');
    }

    /**
     * Returns true when any warehouse holds available stock for this variant.
     */
    public function getIsInStockAttribute(): bool
    {
        return $this->getTotalAvailableStockAttribute() > 0;
    }

    /**
     * Returns the first media gallery image URL, or null.
     */
    public function getPrimaryImageAttribute(): ?string
    {
        $gallery = $this->media_gallery;

        if (empty($gallery)) {
            return null;
        }

        return $gallery[0]['url'] ?? null;
    }
}
