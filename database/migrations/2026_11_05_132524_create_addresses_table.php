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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('address_type', 20);
            $table->boolean('is_default')->default(false);
            $table->string('street_line1', 255);
            $table->string('street_line2', 255)->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('postal_code', 20);
            $table->string('country', 100);
            $table->timestampsTz();

            $table->index('customer_id', 'idx_addresses_customer_id');
        });

        DB::statement("ALTER TABLE addresses ADD CONSTRAINT chk_addresses_address_type CHECK (address_type IN ('shipping', 'billing'))");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS addresses DROP CONSTRAINT IF EXISTS chk_addresses_address_type');
        Schema::dropIfExists('addresses');
    }
};
