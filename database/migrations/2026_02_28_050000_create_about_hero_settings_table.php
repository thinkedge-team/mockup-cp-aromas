<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Perjalanan Kami');
            $table->string('title_main')->default('Menghadirkan Kualitas');
            $table->string('title_italic')->default('Terbaik Untuk Indonesia');
            $table->text('description');
            $table->json('stats')->nullable(); // [{value, label}] max 4
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_hero_settings');
    }
};
