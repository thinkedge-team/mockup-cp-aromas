<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_cta_settings', function (Blueprint $table) {
            $table->id();
            $table->string('headline');
            $table->text('subtext')->nullable();
            $table->string('button_1_text')->default('Lihat Produk');
            $table->string('button_1_url')->default('/#products');
            $table->string('button_2_text')->default('Hubungi Kami');
            $table->string('button_2_url')->default('/#contact');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_cta_settings');
    }
};
