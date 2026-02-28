<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_programs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->comment('franchise|distributor|agen|maklon|implan');
            $table->string('name');
            $table->string('icon')->default('award-fill')->comment('Bootstrap icon class tanpa bi-');
            $table->string('color_hex')->default('#d4a017');
            $table->string('image_url')->nullable()->comment('URL gambar header panel');
            $table->string('badge_label');
            $table->string('panel_title');
            $table->text('panel_subtitle')->nullable();
            $table->json('info_items')->nullable()->comment('Array of {icon, label, value, note, color_class}');
            $table->json('benefits')->nullable()->comment('Array of {text}');
            $table->json('requirements')->nullable()->comment('Array of {text}');
            $table->json('steps')->nullable()->comment('Array of {label, sub}');
            $table->string('cta_title')->nullable();
            $table->string('cta_subtitle')->nullable();
            $table->string('cta_wa_text')->nullable()->comment('Teks pre-fill pesan WhatsApp');
            $table->string('cta_btn_wa_label')->default('Konsultasi Gratis');
            $table->string('cta_btn_form_label')->default('Daftar Sekarang');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_programs');
    }
};
