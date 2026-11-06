<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        Schema::create('category_attributes', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->uuid('attribute_id');
            $table->boolean('is_required_in_category')->default(false);
            $table->integer('sort_order')->default(0);

            $table->primary(['category_id', 'attribute_id']);

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('attribute_id')->references('id')->on('attribute_definitions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_attributes');
    }
};
