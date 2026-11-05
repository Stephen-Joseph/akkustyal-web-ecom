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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
            $table->foreignId('variant_id')->constrained('product_variants')->cascadeOnDelete();
            $table->integer('quantity');
            $table->timestampsTz();

            $table->unique(['cart_id', 'variant_id'], 'uq_cart_variant');
            $table->index('cart_id', 'idx_cart_items_cart_id');
        });

        DB::statement('ALTER TABLE cart_items ADD CONSTRAINT chk_cart_items_quantity CHECK (quantity > 0)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS cart_items DROP CONSTRAINT IF EXISTS chk_cart_items_quantity');
        Schema::dropIfExists('cart_items');
    }
};
