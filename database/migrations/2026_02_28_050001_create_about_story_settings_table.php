<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_story_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Sejarah Kami');
            $table->string('title_main')->default('Kisah di Balik Merek');
            $table->string('title_italic')->default('AROMAS');
            $table->text('lead_paragraph');
            $table->text('body_paragraph_1');
            $table->text('body_paragraph_2')->nullable();
            $table->string('story_image')->nullable(); // file path via Storage
            $table->integer('founded_year')->default(2009);
            $table->string('founded_label')->default('Tahun Berdiri AROMAS');
            $table->string('cert_badge_text')->default('ISO 22000');
            $table->json('pills')->nullable(); // [{icon, text}] max 4
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_story_settings');
    }
};
