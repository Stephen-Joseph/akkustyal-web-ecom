<?php

namespace App\Models;

use App\Enums\ImageRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductImage extends Pivot
{
    use HasUuids;

    /** @var string */
    protected $table = 'product_images';

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $keyType = 'string';

    /** @var list<string> */
    protected $fillable = [
        'product_id',
        'variant_id',
        'image_id',
        'image_name',
        'alt_text',
        'caption',
        'image_role',
        'option_match',
        'is_primary',
        'is_active',
        'sort_order',
    ];

    /** @var array<string, string|class-string> */
    protected $casts = [
        'image_role' => ImageRole::class,
        'option_match' => 'array',
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
