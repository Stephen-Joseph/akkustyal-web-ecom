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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 10, 2);
            $table->timestampTz('created_at');

            $table->index('order_id', 'idx_order_items_order_id');
        });

        DB::statement('ALTER TABLE order_items ADD CONSTRAINT chk_order_items_quantity CHECK (quantity > 0)');
        DB::statement('ALTER TABLE order_items ADD CONSTRAINT chk_order_items_price_at_purchase CHECK (price_at_purchase >= 0)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS order_items DROP CONSTRAINT IF EXISTS chk_order_items_quantity');
        DB::statement('ALTER TABLE IF EXISTS order_items DROP CONSTRAINT IF EXISTS chk_order_items_price_at_purchase');
        Schema::dropIfExists('order_items');
    }
};
