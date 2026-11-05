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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('payment_provider', 50);
            $table->string('transaction_id', 255)->unique();
            $table->decimal('amount', 12, 2);
            $table->string('status', 30);
            $table->string('payment_method', 50);
            $table->timestampsTz();

            $table->index('order_id', 'idx_payments_order_id');
            $table->index('transaction_id', 'idx_payments_transaction_id');
        });

        DB::statement("ALTER TABLE payments ADD CONSTRAINT chk_payments_status CHECK (status IN ('pending', 'completed', 'failed', 'refunded'))");
        DB::statement('ALTER TABLE payments ADD CONSTRAINT chk_payments_amount CHECK (amount >= 0)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE IF EXISTS payments DROP CONSTRAINT IF EXISTS chk_payments_status');
        DB::statement('ALTER TABLE IF EXISTS payments DROP CONSTRAINT IF EXISTS chk_payments_amount');
        Schema::dropIfExists('payments');
    }
};
