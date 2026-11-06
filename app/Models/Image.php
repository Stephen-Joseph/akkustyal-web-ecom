<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /** @var list<string> */
    protected $fillable = [
        'storage_disk',
        'external_asset_id',
        'image_name',
        'original_filename',
        'file_path',
        'cdn_url',
        'mime_type',
        'extension',
        'file_size_bytes',
        'width_px',
        'height_px',
        'focal_point',
        'blurhash',
        'responsive_urls',
        'default_alt_text',
        'uploaded_by',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'file_size_bytes' => 'integer',
        'width_px' => 'integer',
        'height_px' => 'integer',
        'aspect_ratio' => 'float',
        'focal_point' => 'array',
        'responsive_urls' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * Products associated with this master media asset via the product_images pivot.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_images', 'image_id', 'product_id')
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
            ->withTimestamps();
    }

    /**
     * Product variants associated with this image asset.
     */
    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'product_images', 'image_id', 'variant_id')
            ->using(ProductImage::class)
            ->withPivot([
                'id',
                'product_id',
                'image_name',
                'alt_text',
                'caption',
                'image_role',
                'option_match',
                'is_primary',
                'is_active',
                'sort_order',
            ])
            ->withTimestamps();
    }

    /**
     * Raw junction assignments.
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'image_id');
    }
}
