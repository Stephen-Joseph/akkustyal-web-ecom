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
        Schema::create('variant_prices', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('variant_id');
            $table->char('currency_code', 3)->default('INR');
            $table->decimal('msrp_price', 12, 2);
            $table->decimal('retail_price', 12, 2);
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->timestampTz('sale_starts_at')->nullable();
            $table->timestampTz('sale_ends_at')->nullable();
            $table->string('tax_class', 50)->default('standard');
            $table->boolean('is_tax_inclusive')->default(true);
            $table->timestampsTz();

            $table->unique(['variant_id', 'currency_code'], 'uq_variant_currency');
        });

        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT variant_prices_variant_id_foreign FOREIGN KEY (variant_id) REFERENCES product_variants(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_msrp_price CHECK (msrp_price >= 0)');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_retail_price CHECK (retail_price >= 0)');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_cost_price CHECK (cost_price IS NULL OR cost_price >= 0)');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_sale_price CHECK (sale_price IS NULL OR sale_price >= 0)');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_retail_lte_msrp CHECK (retail_price <= msrp_price)');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_sale_lt_retail CHECK (sale_price IS NULL OR sale_price < retail_price)');
        DB::statement('ALTER TABLE variant_prices ADD CONSTRAINT chk_sale_window_valid CHECK ((sale_starts_at IS NULL AND sale_ends_at IS NULL) OR (sale_starts_at IS NOT NULL AND sale_ends_at IS NOT NULL AND sale_ends_at > sale_starts_at))');
    }

    public function down(): void
    {
        Schema::dropIfExists('variant_prices');
    }
};
