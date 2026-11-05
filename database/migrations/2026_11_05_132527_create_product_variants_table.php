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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('sku', 100)->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->jsonb('attributes')->nullable();
            $table->timestampsTz();

            $table->index('product_id', 'idx_product_variants_product_id');
            $table->index('sku', 'idx_product_variants_sku');
        });

        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_product_variants_price CHECK (price >= 0)');
        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_product_variants_compare_at_price CHECK (compare_at_price IS NULL OR compare_at_price >= 0)');
        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_product_variants_stock_quantity CHECK (stock_quantity >= 0)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS product_variants DROP CONSTRAINT IF EXISTS chk_product_variants_price');
        DB::statement('ALTER TABLE IF EXISTS product_variants DROP CONSTRAINT IF EXISTS chk_product_variants_compare_at_price');
        DB::statement('ALTER TABLE IF EXISTS product_variants DROP CONSTRAINT IF EXISTS chk_product_variants_stock_quantity');
        Schema::dropIfExists('product_variants');
    }
};
