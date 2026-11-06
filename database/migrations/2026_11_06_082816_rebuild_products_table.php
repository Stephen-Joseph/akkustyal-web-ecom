<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        // Drop all dependent tables that FK to products/product_variants/categories (old schema)
        // Drop in reverse dependency order
        DB::statement('DROP TABLE IF EXISTS product_images CASCADE');
        DB::statement('DROP TABLE IF EXISTS product_reviews CASCADE');
        DB::statement('DROP TABLE IF EXISTS wishlists CASCADE');
        DB::statement('DROP TABLE IF EXISTS cart_items CASCADE');
        DB::statement('DROP TABLE IF EXISTS order_items CASCADE');
        DB::statement('DROP TABLE IF EXISTS product_variants CASCADE');
        DB::statement('DROP TABLE IF EXISTS products CASCADE');

        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('brand_id')->nullable();
            $table->string('name', 255);
            $table->string('slug', 280)->unique();
            $table->string('short_description', 500)->nullable();
            $table->text('description')->nullable();
            $table->jsonb('base_attributes')->default('{}');
            $table->jsonb('seo_metadata')->default('{}');
            $table->timestampTz('published_at')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        // Add custom ENUM columns
        DB::statement("ALTER TABLE products ADD COLUMN product_type product_type_enum NOT NULL DEFAULT 'simple'");
        DB::statement("ALTER TABLE products ADD COLUMN status product_status_enum NOT NULL DEFAULT 'draft'");

        // Add FK to brands
        DB::statement('ALTER TABLE products ADD CONSTRAINT products_brand_id_foreign FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE SET NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
