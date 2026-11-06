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
        Schema::create('product_relationships', function (Blueprint $table) {
            $table->uuid('source_product_id');
            $table->uuid('target_product_id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_bidirectional')->default(false);
            $table->timestampTz('created_at')->useCurrent();
        });

        // Add custom ENUM column for relation_type
        DB::statement("ALTER TABLE product_relationships ADD COLUMN relation_type product_relation_enum NOT NULL");

        // Composite PK including enum column
        DB::statement('ALTER TABLE product_relationships ADD PRIMARY KEY (source_product_id, target_product_id, relation_type)');

        DB::statement('ALTER TABLE product_relationships ADD CONSTRAINT product_relationships_source_fk FOREIGN KEY (source_product_id) REFERENCES products(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE product_relationships ADD CONSTRAINT product_relationships_target_fk FOREIGN KEY (target_product_id) REFERENCES products(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE product_relationships ADD CONSTRAINT chk_no_self_product_relation CHECK (source_product_id <> target_product_id)');
    }

    public function down(): void
    {
        Schema::dropIfExists('product_relationships');
    }
};
