<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "pgcrypto"');
        DB::statement('CREATE EXTENSION IF NOT EXISTS "ltree"');
        DB::statement('CREATE EXTENSION IF NOT EXISTS "btree_gist"');

        DB::statement("CREATE TYPE product_status_enum AS ENUM ('draft', 'active', 'archived')");
        DB::statement("CREATE TYPE product_type_enum AS ENUM ('simple', 'configurable', 'bundle', 'digital')");
        DB::statement("CREATE TYPE product_relation_enum AS ENUM ('accessory', 'spare_part', 'cross_sell', 'upsell', 'substitute')");
        DB::statement("CREATE TYPE attribute_type_enum AS ENUM ('text', 'number', 'boolean', 'select', 'multiselect', 'color')");
    }

    public function down(): void
    {
        DB::statement('DROP TYPE IF EXISTS attribute_type_enum');
        DB::statement('DROP TYPE IF EXISTS product_relation_enum');
        DB::statement('DROP TYPE IF EXISTS product_type_enum');
        DB::statement('DROP TYPE IF EXISTS product_status_enum');

        DB::statement('DROP EXTENSION IF EXISTS "btree_gist"');
        DB::statement('DROP EXTENSION IF EXISTS "ltree"');
        DB::statement('DROP EXTENSION IF EXISTS "pgcrypto"');
    }
};
