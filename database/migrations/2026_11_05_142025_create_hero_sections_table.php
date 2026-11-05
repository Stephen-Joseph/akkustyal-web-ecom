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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section')->unique();

            $table->string('headline', 160);
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();

            $table->string('primary_button_text', 80);
            $table->text('primary_button_url');

            $table->string('secondary_button_text', 80);
            $table->text('secondary_button_url');

            $table->string('stat_1_value', 30)->default('0');
            $table->string('stat_1_label', 80);

            $table->string('stat_2_value', 30)->default('0');
            $table->string('stat_2_label', 80);

            $table->string('stat_3_value', 30)->default('0');
            $table->string('stat_3_label', 80);

            $table->timestamps();
        });

        // Default homepage hero content
        DB::table('hero_sections')->insert([
            'section' => 'home',
            'headline' => 'TAKE THE FIRST STEP.',
            'description' => 'Discover your style, embrace confidence, and move forward with essentials designed for every journey.',
            'primary_button_text' => 'CHASE',
            'primary_button_url' => '#',
            'secondary_button_text' => 'Explore Drops',
            'secondary_button_url' => '#spotlight',
            'stat_1_value' => '0',
            'stat_1_label' => 'Style Community',
            'stat_2_value' => '0',
            'stat_2_label' => 'Fast & Reliable Delivery',
            'stat_3_value' => '0',
            'stat_3_label' => 'Comfort-First Fabrics',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
