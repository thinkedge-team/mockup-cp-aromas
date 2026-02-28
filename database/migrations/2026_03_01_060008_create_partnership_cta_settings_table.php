<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_cta_settings', function (Blueprint $table) {
            $table->id();
            $table->string('headline');
            $table->text('subtext')->nullable();
            $table->string('button_1_text')->default('Mulai Konsultasi');
            $table->string('button_1_url')->nullable()->comment('URL atau path, jika pakai WA kosongkan');
            $table->string('wa_number')->default('6281234567890')->comment('Nomor WA untuk tombol 1');
            $table->string('wa_message')->nullable()->comment('Pre-fill pesan WA tombol 1');
            $table->string('button_2_text')->default('Kirim Formulir');
            $table->string('button_2_url')->default('/contact');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_cta_settings');
    }
};
