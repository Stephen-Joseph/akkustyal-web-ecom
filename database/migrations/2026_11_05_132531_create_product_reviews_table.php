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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->boolean('is_verified_purchase')->default(false);
            $table->timestampsTz();

            $table->unique(['customer_id', 'product_id'], 'uq_customer_product_review');
            $table->index('product_id', 'idx_product_reviews_product_id');
        });

        DB::statement('ALTER TABLE product_reviews ADD CONSTRAINT chk_product_reviews_rating CHECK (rating BETWEEN 1 AND 5)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS product_reviews DROP CONSTRAINT IF EXISTS chk_product_reviews_rating');
        Schema::dropIfExists('product_reviews');
    }
};
