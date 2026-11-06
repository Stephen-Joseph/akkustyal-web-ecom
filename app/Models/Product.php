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

    /**
     * Master media assets connected via the product_images pivot table.
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_images', 'product_id', 'image_id')
            ->using(ProductImage::class)
            ->withPivot([
                'id',
                'variant_id',
                'image_name',
                'alt_text',
                'caption',
                'image_role',
                'option_match',
                'is_primary',
                'is_active',
                'sort_order',
            ])
            ->withTimestamps()
            ->orderByPivot('is_primary', 'desc')
            ->orderByPivot('sort_order', 'asc');
    }

    /**
     * Direct product_images junction entries.
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->orderBy('is_primary', 'desc')
            ->orderBy('sort_order', 'asc');
    }

    /**
     * The primary hero image for the base product.
     */
    public function primaryProductImage(): BelongsToMany
    {
        return $this->images()
            ->wherePivot('is_primary', true)
            ->wherePivotNull('variant_id');
    }

    public function defaultVariant(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_default', true)->withoutTrashed();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')
            ->using(CategoryProduct::class)
            ->withPivot(['is_primary', 'sort_order'])
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
     * Returns the primary image URL from the DAM images pivot, or first available image.
     */
    public function getPrimaryImageAttribute(): ?string
    {
        $primary = $this->images->first(fn ($img) => (bool) ($img->pivot?->is_primary && is_null($img->pivot?->variant_id)));
        if ($primary) {
            return $primary->cdn_url;
        }

        if ($this->images->isNotEmpty()) {
            return $this->images->first()?->cdn_url;
        }

        return $this->variants->first()?->primary_image;
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
