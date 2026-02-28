<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Program Kemitraan AROMAS');
            $table->string('title_main')->default('Tumbuh Bersama Kami,');
            $table->string('title_italic')->default('Raih Sukses Bersama');
            $table->text('description')->nullable();
            $table->string('wa_number')->default('6281234567890')->comment('Nomor WA tanpa +, untuk link konsultasi');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_hero_settings');
    }
};
