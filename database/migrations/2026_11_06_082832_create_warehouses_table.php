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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('code', 32)->unique();
            $table->string('name', 150);
            $table->char('country_code', 2)->default('IN');
            $table->string('state_code', 32)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->jsonb('address_details')->default('{}');
            $table->integer('priority')->default(100);
            $table->boolean('is_active')->default(true);
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
