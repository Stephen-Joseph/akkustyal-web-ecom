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
        Schema::create('variant_tiered_prices', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('variant_id');
            $table->char('currency_code', 3)->default('INR');
            $table->string('customer_group', 50)->default('ALL');
            $table->integer('min_quantity');
            $table->integer('max_quantity')->nullable();
            $table->decimal('unit_price', 12, 2);
            $table->timestampTz('starts_at')->nullable();
            $table->timestampTz('ends_at')->nullable();
            $table->timestampsTz();

            $table->unique(['variant_id', 'currency_code', 'customer_group', 'min_quantity'], 'uq_tiered_price_tier');
        });

        DB::statement('ALTER TABLE variant_tiered_prices ADD CONSTRAINT variant_tiered_prices_variant_id_foreign FOREIGN KEY (variant_id) REFERENCES product_variants(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE variant_tiered_prices ADD CONSTRAINT chk_tier_min_quantity CHECK (min_quantity > 1)');
        DB::statement('ALTER TABLE variant_tiered_prices ADD CONSTRAINT chk_tier_max_quantity CHECK (max_quantity IS NULL OR max_quantity >= min_quantity)');
        DB::statement('ALTER TABLE variant_tiered_prices ADD CONSTRAINT chk_tier_unit_price CHECK (unit_price >= 0)');
        DB::statement('ALTER TABLE variant_tiered_prices ADD CONSTRAINT chk_tier_window_valid CHECK (ends_at IS NULL OR starts_at IS NULL OR ends_at > starts_at)');
    }

    public function down(): void
    {
        Schema::dropIfExists('variant_tiered_prices');
    }
};
