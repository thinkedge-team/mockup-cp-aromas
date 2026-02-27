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
        Schema::create('machine_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('badge_icon')->default('bi-gear-wide-connected');
            $table->string('badge_text')->default('Fasilitas Produksi');
            $table->string('title');
            $table->string('title_gradient');
            $table->string('production_line_image');
            $table->json('hero_stats')->nullable(); // [{icon, number, label}]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_heroes');
    }
};
