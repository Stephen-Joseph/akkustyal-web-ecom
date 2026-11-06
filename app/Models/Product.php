<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasUuids, SoftDeletes;

    /** @var list<string> */
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'product_type',
        'status',
        'short_description',
        'description',
        'base_attributes',
        'seo_metadata',
        'published_at',
    ];

    /** @var array<string, string|class-string> */
    protected $casts = [
        'product_type' => ProductType::class,
        'status' => ProductStatus::class,
        'base_attributes' => 'array',
        'seo_metadata' => 'array',
        'published_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->orderBy('sort_order');
    }

    public function defaultVariant(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_default', true)->withoutTrashed();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')
            ->using(CategoryProduct::class)
            ->withPivot(['is_primary', 'sort_order', 'created_at'])
            ->orderByPivot('sort_order');
    }

    /**
     * Alias for categories() to maintain backwards-compatibility with singular access.
     */
    public function category(): BelongsToMany
    {
        return $this->categories();
    }

    /**
     * The primary (SEO) category for breadcrumb and canonical URL resolution.
     */
    public function primaryCategory(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')
            ->wherePivot('is_primary', true);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Products related to this one (outgoing edges from this product as source).
     */
    public function relatedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_relationships', 'source_product_id', 'target_product_id')
            ->using(ProductRelationship::class)
            ->withPivot(['relation_type', 'sort_order', 'is_bidirectional'])
            ->orderByPivot('sort_order');
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /**
     * Scope to only include products that are published and active.
     *
     * @param Builder<Product> $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', ProductStatus::Active)
            ->where(function (Builder $q): void {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Scope to only include products with a specific status.
     *
     * @param Builder<Product> $query
     */
    public function scopeWithStatus(Builder $query, ProductStatus $status): void
    {
        $query->where('status', $status);
    }

    /**
     * Scope to filter products by JSONB base_attributes containment.
     * Uses the GIN (jsonb_path_ops) index for fast faceted filtering.
     *
     * @param Builder<Product>  $query
     * @param array<string, mixed> $attributes
     */
    public function scopeWithBaseAttributes(Builder $query, array $attributes): void
    {
        $query->whereRaw('base_attributes @> ?::jsonb', [json_encode($attributes)]);
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    /**
     * Returns the first active variant's first media_gallery image URL, or null.
     */
    public function getPrimaryImageAttribute(): ?string
    {
        $gallery = $this->variants->first()?->media_gallery;

        if (empty($gallery)) {
            return null;
        }

        return is_array($gallery) ? ($gallery[0]['url'] ?? null) : null;
    }

    /**
     * Returns the lowest retail price across all active variants.
     */
    public function getMinPriceAttribute(): ?string
    {
        return $this->variants
            ->where('is_active', true)
            ->min(fn (ProductVariant $v) => $v->prices->min('retail_price'));
    }
}
