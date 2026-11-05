<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
            $table->timestampTz('created_at');

            $table->unique(['customer_id', 'product_id'], 'uq_customer_wishlist_product');
            $table->index('customer_id', 'idx_wishlists_customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
