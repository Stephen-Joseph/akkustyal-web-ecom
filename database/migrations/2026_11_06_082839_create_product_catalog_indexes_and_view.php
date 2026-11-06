<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        // GiST index for ltree path on categories
        DB::statement('CREATE INDEX idx_categories_path_gist ON categories USING GIST (path)');

        // Partial index for active category parents
        DB::statement('CREATE INDEX idx_categories_parent_id ON categories (parent_id) WHERE is_active = TRUE');

        // Category-product pivot indexes
        DB::statement('CREATE INDEX idx_category_product_reverse ON category_product (product_id, category_id)');
        DB::statement('CREATE UNIQUE INDEX idx_category_product_one_primary ON category_product (product_id) WHERE is_primary = TRUE');

        // Category-attributes reverse
        DB::statement('CREATE INDEX idx_category_attributes_reverse ON category_attributes (attribute_id, category_id)');

        // Products indexes
        DB::statement("CREATE INDEX idx_products_brand_status ON products (brand_id, status) WHERE deleted_at IS NULL");
        DB::statement("CREATE INDEX idx_products_active_published ON products (published_at DESC) WHERE status = 'active' AND deleted_at IS NULL");
        DB::statement('CREATE INDEX idx_products_base_attributes_gin ON products USING GIN (base_attributes jsonb_path_ops)');

        // Product variants indexes
        DB::statement('CREATE INDEX idx_variants_options_gin ON product_variants USING GIN (variant_options jsonb_path_ops)');
        DB::statement('CREATE INDEX idx_variants_specs_gin ON product_variants USING GIN (technical_specs jsonb_path_ops)');
        DB::statement('CREATE INDEX idx_variants_product_active ON product_variants (product_id, is_active, sort_order) WHERE deleted_at IS NULL');
        DB::statement('CREATE UNIQUE INDEX idx_variants_one_default_per_product ON product_variants (product_id) WHERE is_default = TRUE AND deleted_at IS NULL');
        DB::statement('CREATE INDEX idx_variants_barcode ON product_variants (barcode) WHERE barcode IS NOT NULL');

        // Product relationships
        DB::statement('CREATE INDEX idx_product_relations_target ON product_relationships (target_product_id, relation_type)');

        // Product bundles
        DB::statement('CREATE INDEX idx_product_bundles_child ON product_bundles (child_variant_id)');

        // Inventory levels
        DB::statement('CREATE INDEX idx_inventory_variant_available ON inventory_levels (variant_id, quantity_available DESC)');
        DB::statement('CREATE INDEX idx_inventory_low_stock ON inventory_levels (warehouse_id, variant_id) WHERE quantity_available <= low_stock_threshold');

        // Variant prices
        DB::statement('CREATE INDEX idx_variant_prices_lookup ON variant_prices (variant_id, currency_code)');
        DB::statement('CREATE INDEX idx_variant_prices_active_sales ON variant_prices (sale_starts_at, sale_ends_at) WHERE sale_price IS NOT NULL');

        // Variant tiered prices
        DB::statement('CREATE INDEX idx_tiered_prices_lookup ON variant_tiered_prices (variant_id, currency_code, customer_group, min_quantity)');

        // Active variant pricing view
        DB::statement("
            CREATE OR REPLACE VIEW vw_active_variant_pricing AS
            SELECT
                vp.variant_id,
                vp.currency_code,
                vp.msrp_price,
                vp.retail_price,
                vp.sale_price,
                CASE
                    WHEN vp.sale_price IS NOT NULL
                     AND (vp.sale_starts_at IS NULL OR vp.sale_starts_at <= NOW())
                     AND (vp.sale_ends_at IS NULL OR vp.sale_ends_at >= NOW())
                    THEN vp.sale_price
                    ELSE vp.retail_price
                END AS effective_price,
                CASE
                    WHEN vp.sale_price IS NOT NULL
                     AND (vp.sale_starts_at IS NULL OR vp.sale_starts_at <= NOW())
                     AND (vp.sale_ends_at IS NULL OR vp.sale_ends_at >= NOW())
                    THEN TRUE ELSE FALSE
                END AS is_on_sale,
                vp.tax_class,
                vp.is_tax_inclusive
            FROM variant_prices vp
        ");
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        DB::statement('DROP VIEW IF EXISTS vw_active_variant_pricing');

        $indexes = [
            'idx_tiered_prices_lookup' => 'variant_tiered_prices',
            'idx_variant_prices_active_sales' => 'variant_prices',
            'idx_variant_prices_lookup' => 'variant_prices',
            'idx_inventory_low_stock' => 'inventory_levels',
            'idx_inventory_variant_available' => 'inventory_levels',
            'idx_product_bundles_child' => 'product_bundles',
            'idx_product_relations_target' => 'product_relationships',
            'idx_variants_barcode' => 'product_variants',
            'idx_variants_one_default_per_product' => 'product_variants',
            'idx_variants_product_active' => 'product_variants',
            'idx_variants_specs_gin' => 'product_variants',
            'idx_variants_options_gin' => 'product_variants',
            'idx_products_base_attributes_gin' => 'products',
            'idx_products_active_published' => 'products',
            'idx_products_brand_status' => 'products',
            'idx_category_attributes_reverse' => 'category_attributes',
            'idx_category_product_one_primary' => 'category_product',
            'idx_category_product_reverse' => 'category_product',
            'idx_categories_parent_id' => 'categories',
            'idx_categories_path_gist' => 'categories',
        ];

        foreach ($indexes as $index => $table) {
            DB::statement("DROP INDEX IF EXISTS {$index}");
        }
    }
};
