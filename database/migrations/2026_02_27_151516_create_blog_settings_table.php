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
        Schema::create('blog_settings', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('badge_text')->default('Blog & Artikel Resmi');
            $table->string('badge_icon')->default('bi-newspaper');
            $table->string('title')->default('Tips, Resep & Edukasi');
            $table->string('title_emphasis')->default('Seputar Memasak');
            $table->text('description')->nullable();
            $table->json('stats')->nullable();
            // CTA Section
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->json('cta_buttons')->nullable();
            // SEO Settings
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_settings');
    }
};
