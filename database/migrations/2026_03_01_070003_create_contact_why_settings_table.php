<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_why_settings', function (Blueprint $table) {
            $table->id();
            $table->string('label')->default('Mengapa Hubungi Kami?');
            $table->string('title')->default('Kami Mitra Bisnis');
            $table->string('title_highlight')->default('Terpercaya');
            $table->json('why_items')->nullable(); // [{icon, title, text}]
            // Jam Operasional di sidebar
            $table->string('hours_weekday')->default('Senin – Jumat : 08.00 – 17.00');
            $table->string('hours_saturday')->default('Sabtu : 08.00 – 13.00');
            $table->string('hours_sunday')->default('Minggu & Hari Libur : Tutup');
            $table->string('hours_wa_note')->default('WhatsApp Order : 24 Jam / 7 Hari');
            // Social media links
            $table->string('wa_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('email_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_why_settings');
    }
};
