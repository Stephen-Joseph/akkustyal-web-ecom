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
        Schema::create('attribute_definitions', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('code', 64)->unique();
            $table->string('name', 120);
            $table->string('unit', 32)->nullable();
            $table->jsonb('allowed_values')->nullable();
            $table->boolean('is_variant_axis')->default(false);
            $table->boolean('is_filterable')->default(true);
            $table->boolean('is_searchable')->default(false);
            $table->boolean('is_required')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();
        });

        // data_type uses custom ENUM type
        DB::statement("ALTER TABLE attribute_definitions ADD COLUMN data_type attribute_type_enum NOT NULL");
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_definitions');
    }
};
