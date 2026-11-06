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
        // Drop old products FK to categories before dropping categories
        DB::statement('ALTER TABLE IF EXISTS products DROP CONSTRAINT IF EXISTS products_category_id_foreign');

        Schema::dropIfExists('categories');

        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('parent_id')->nullable();
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->jsonb('seo_metadata')->default('{}');
            $table->smallInteger('depth')->default(0);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestampsTz();
        });

        // Add ltree path column (Blueprint doesn't support ltree natively)
        DB::statement("ALTER TABLE categories ADD COLUMN path ltree NOT NULL DEFAULT ''::ltree");

        // Self-referential FK
        DB::statement('ALTER TABLE categories ADD CONSTRAINT categories_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE RESTRICT');

        // depth >= 0
        DB::statement('ALTER TABLE categories ADD CONSTRAINT chk_category_depth CHECK (depth >= 0)');

        // Self-parent guard
        DB::statement('ALTER TABLE categories ADD CONSTRAINT chk_category_not_self_parent CHECK (id <> parent_id)');
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
