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
        Schema::create('promo_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Penawaran Terbatas');
            $table->string('badge_icon')->default('bi-lightning-charge-fill');
            $table->string('title')->default('Promo Spesial AROMAS');
            $table->text('description')->nullable();
            $table->string('countdown_label')->default('Promo berakhir dalam');
            $table->dateTime('countdown_target')->nullable();
            $table->json('stats')->nullable(); // [{icon, value, label, order}]
            $table->json('float_tags')->nullable(); // [{icon, text, position, order}]
            $table->string('background_color_start')->default('#1a2e1a');
            $table->string('background_color_end')->default('#15412a');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_hero_settings');
    }
};
