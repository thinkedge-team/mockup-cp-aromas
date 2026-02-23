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
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_key')->unique(); // primary_color, secondary_color, etc.
            $table->string('setting_value')->nullable();
            $table->string('setting_type')->default('color'); // color, font, number, boolean
            $table->string('label');
            $table->string('group')->default('colors'); // colors, fonts, spacing, borders
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
    }
};
