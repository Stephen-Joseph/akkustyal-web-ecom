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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->string('status', 30)->default('pending');
            $table->decimal('total_amount', 12, 2);
            $table->foreignId('shipping_address_id')->constrained('addresses')->restrictOnDelete();
            $table->foreignId('billing_address_id')->constrained('addresses')->restrictOnDelete();
            $table->timestampsTz();

            $table->index('customer_id', 'idx_orders_customer_id');
            $table->index('status', 'idx_orders_status');
        });

        DB::statement("ALTER TABLE orders ADD CONSTRAINT chk_orders_status CHECK (status IN ('pending', 'processing', 'shipped', 'delivered', 'cancelled'))");
        DB::statement('ALTER TABLE orders ADD CONSTRAINT chk_orders_total_amount CHECK (total_amount >= 0)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS orders DROP CONSTRAINT IF EXISTS chk_orders_status');
        DB::statement('ALTER TABLE IF EXISTS orders DROP CONSTRAINT IF EXISTS chk_orders_total_amount');
        Schema::dropIfExists('orders');
    }
};
