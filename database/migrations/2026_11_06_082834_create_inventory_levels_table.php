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
        Schema::create('inventory_levels', function (Blueprint $table) {
            $table->uuid('warehouse_id');
            $table->uuid('variant_id');
            $table->integer('quantity_on_hand')->default(0);
            $table->integer('quantity_reserved')->default(0);
            $table->integer('low_stock_threshold')->default(5);
            $table->string('bin_location', 64)->nullable();
            $table->timestampTz('updated_at')->useCurrent();

            $table->primary(['warehouse_id', 'variant_id']);

            $table->foreign('warehouse_id')->references('id')->on('warehouses')->restrictOnDelete();
            $table->foreign('variant_id')->references('id')->on('product_variants')->cascadeOnDelete();
        });

        // Generated STORED column — requires DB::statement
        DB::statement('ALTER TABLE inventory_levels ADD COLUMN quantity_available INTEGER GENERATED ALWAYS AS (quantity_on_hand - quantity_reserved) STORED');

        DB::statement('ALTER TABLE inventory_levels ADD CONSTRAINT chk_inv_on_hand CHECK (quantity_on_hand >= 0)');
        DB::statement('ALTER TABLE inventory_levels ADD CONSTRAINT chk_inv_reserved CHECK (quantity_reserved >= 0)');
        DB::statement('ALTER TABLE inventory_levels ADD CONSTRAINT chk_inv_low_stock CHECK (low_stock_threshold >= 0)');
        DB::statement('ALTER TABLE inventory_levels ADD CONSTRAINT chk_reserved_within_on_hand CHECK (quantity_reserved <= quantity_on_hand)');
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_levels');
    }
};
