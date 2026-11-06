<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasUuids;

    /** @var list<string> */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'path',
        'depth',
        'description',
        'image_url',
        'seo_metadata',
        'sort_order',
        'is_active',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'seo_metadata' => 'array',
        'depth' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')
            ->using(CategoryProduct::class)
            ->withPivot(['is_primary', 'sort_order', 'created_at'])
            ->orderByPivot('sort_order');
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(AttributeDefinition::class, 'category_attributes', 'category_id', 'attribute_id')
            ->using(CategoryAttribute::class)
            ->withPivot(['is_required_in_category', 'sort_order'])
            ->orderByPivot('sort_order');
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /** @param Builder<Category> $query */
    public function scopeRoots(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    /** @param Builder<Category> $query */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope to fetch all categories that are descendants of (or equal to) the given ltree path.
     * Uses PostgreSQL's native ltree <@ operator via the GiST index for instant subtree queries.
     *
     * @param Builder<Category> $query
     */
    public function scopeDescendantsOf(Builder $query, string $ancestorPath): void
    {
        $query->whereRaw("path <@ ?::ltree", [$ancestorPath]);
    }

    /**
     * Scope to fetch all categories whose path is a prefix of (ancestor of) the given path.
     * Useful for breadcrumb generation.
     *
     * @param Builder<Category> $query
     */
    public function scopeAncestorsOf(Builder $query, string $descendantPath): void
    {
        $query->whereRaw("path @> ?::ltree", [$descendantPath]);
    }
}
