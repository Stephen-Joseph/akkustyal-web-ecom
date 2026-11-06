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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('product_id');
            $table->string('sku', 100)->unique();
            $table->string('barcode', 64)->nullable();
            $table->string('name', 255);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('track_inventory')->default(true);
            $table->integer('weight_grams')->default(0);
            $table->integer('length_mm')->default(0);
            $table->integer('width_mm')->default(0);
            $table->integer('height_mm')->default(0);
            $table->jsonb('variant_options')->default('{}');
            $table->jsonb('technical_specs')->default('{}');
            $table->jsonb('media_gallery')->default('[]');
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT product_variants_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_variants_weight CHECK (weight_grams >= 0)');
        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_variants_length CHECK (length_mm >= 0)');
        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_variants_width CHECK (width_mm >= 0)');
        DB::statement('ALTER TABLE product_variants ADD CONSTRAINT chk_variants_height CHECK (height_mm >= 0)');

        // Recreate dependent tables with UUID FKs
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
            $table->uuid('variant_id');
            $table->integer('quantity');
            $table->timestampsTz();

            $table->unique(['cart_id', 'variant_id'], 'uq_cart_variant');
            $table->index('cart_id', 'idx_cart_items_cart_id');
        });

        DB::statement('ALTER TABLE cart_items ADD CONSTRAINT cart_items_variant_id_foreign FOREIGN KEY (variant_id) REFERENCES product_variants(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE cart_items ADD CONSTRAINT chk_cart_items_quantity CHECK (quantity > 0)');

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->uuid('variant_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 10, 2);
            $table->timestampTz('created_at')->useCurrent();

            $table->index('order_id', 'idx_order_items_order_id');
        });

        DB::statement('ALTER TABLE order_items ADD CONSTRAINT order_items_variant_id_foreign FOREIGN KEY (variant_id) REFERENCES product_variants(id) ON DELETE SET NULL');
        DB::statement('ALTER TABLE order_items ADD CONSTRAINT chk_order_items_quantity CHECK (quantity > 0)');
        DB::statement('ALTER TABLE order_items ADD CONSTRAINT chk_order_items_price_at_purchase CHECK (price_at_purchase >= 0)');

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->uuid('product_id');
            $table->uuid('variant_id')->nullable();
            $table->timestampTz('created_at')->useCurrent();

            $table->unique(['customer_id', 'product_id'], 'uq_customer_wishlist_product');
            $table->index('customer_id', 'idx_wishlists_customer_id');
        });

        DB::statement('ALTER TABLE wishlists ADD CONSTRAINT wishlists_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE wishlists ADD CONSTRAINT wishlists_variant_id_foreign FOREIGN KEY (variant_id) REFERENCES product_variants(id) ON DELETE SET NULL');

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_id');
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->boolean('is_verified_purchase')->default(false);
            $table->timestampsTz();

            $table->unique(['customer_id', 'product_id'], 'uq_customer_product_review');
            $table->index('product_id', 'idx_product_reviews_product_id');
        });

        DB::statement('ALTER TABLE product_reviews ADD CONSTRAINT product_reviews_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE product_reviews ADD CONSTRAINT chk_product_reviews_rating CHECK (rating BETWEEN 1 AND 5)');
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('product_variants');
    }
};
