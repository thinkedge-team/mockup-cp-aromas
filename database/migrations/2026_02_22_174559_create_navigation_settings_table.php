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
        Schema::create('navigation_settings', function (Blueprint $table) {
            $table->id();
            $table->string('location')->unique(); // header, footer, mobile
            $table->json('menu_items'); // Repeater: label, url, icon, order, dropdown_items
            $table->string('logo')->nullable(); // Logo path
            $table->integer('logo_height')->default(44); // Logo height in px
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->boolean('is_sticky')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_settings');
    }
};
