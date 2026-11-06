<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->uuid('product_id');
            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestampTz('created_at')->useCurrent();

            $table->primary(['category_id', 'product_id']);

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
