<?php

namespace App\Models;

use App\Enums\ProductRelation;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for the product_relationships table.
 *
 * @property string          $source_product_id
 * @property string          $target_product_id
 * @property ProductRelation $relation_type
 * @property int             $sort_order
 * @property bool            $is_bidirectional
 * @property string          $created_at
 */
class ProductRelationship extends Pivot
{
    public const UPDATED_AT = null;

    /** @var string */
    protected $table = 'product_relationships';

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'source_product_id',
        'target_product_id',
        'relation_type',
        'sort_order',
        'is_bidirectional',
    ];

    /** @var array<string, string|class-string> */
    protected $casts = [
        'relation_type' => ProductRelation::class,
        'sort_order' => 'integer',
        'is_bidirectional' => 'boolean',
    ];

    /**
     * Get the name of the "updated at" column (null since table has only created_at).
     */
    public function getUpdatedAtColumn(): ?string
    {
        return null;
    }
}
