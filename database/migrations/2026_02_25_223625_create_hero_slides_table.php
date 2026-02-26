<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->string('badge_icon')->default('bi-award-fill');
            $table->string('badge_text');
            $table->string('title');
            $table->string('title_gradient');
            $table->text('description');
            $table->json('pills')->nullable(); // Array of pill texts
            $table->string('primary_button_text');
            $table->string('primary_button_url');
            $table->string('secondary_button_text');
            $table->string('secondary_button_url');
            $table->json('trust_items')->nullable(); // [{number, label}]
            $table->json('floating_cards')->nullable(); // [{icon, title, subtitle}]
            $table->string('background_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
