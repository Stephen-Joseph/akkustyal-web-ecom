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
        Schema::create('product_bundles', function (Blueprint $table) {
            $table->uuid('parent_variant_id');
            $table->uuid('child_variant_id');
            $table->integer('quantity');
            $table->decimal('revenue_allocation_pct', 5, 2)->default(0.00);
            $table->integer('sort_order')->default(0);
            $table->timestampTz('created_at')->useCurrent();

            $table->primary(['parent_variant_id', 'child_variant_id']);

            $table->foreign('parent_variant_id')->references('id')->on('product_variants')->cascadeOnDelete();
            $table->foreign('child_variant_id')->references('id')->on('product_variants')->restrictOnDelete();
        });

        DB::statement('ALTER TABLE product_bundles ADD CONSTRAINT chk_bundle_quantity CHECK (quantity > 0)');
        DB::statement('ALTER TABLE product_bundles ADD CONSTRAINT chk_bundle_revenue_pct CHECK (revenue_allocation_pct >= 0 AND revenue_allocation_pct <= 100)');
        DB::statement('ALTER TABLE product_bundles ADD CONSTRAINT chk_no_self_bundle_component CHECK (parent_variant_id <> child_variant_id)');
    }

    public function down(): void
    {
        Schema::dropIfExists('product_bundles');
    }
};
