<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
            $table->text('image_url');
            $table->integer('sort_order')->default(0);
            $table->timestampTz('created_at');

            $table->index('product_id', 'idx_product_images_product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
