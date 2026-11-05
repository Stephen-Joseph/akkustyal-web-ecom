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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->string('session_id', 255)->nullable();
            $table->timestampsTz();

            $table->index('customer_id', 'idx_carts_customer_id');
            $table->index('session_id', 'idx_carts_session_id');
        });

        DB::statement('ALTER TABLE carts ADD CONSTRAINT chk_carts_customer_or_session CHECK (customer_id IS NOT NULL OR session_id IS NOT NULL)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS carts DROP CONSTRAINT IF EXISTS chk_carts_customer_or_session');
        Schema::dropIfExists('carts');
    }
};
