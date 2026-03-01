<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Kami Siap Membantu');
            $table->string('title_line1')->default('Hubungi Tim');
            $table->string('title_highlight')->default('AROMAS');
            $table->text('description')->nullable();
            $table->string('chip_1_icon')->default('lightning-charge-fill');
            $table->string('chip_1_text')->default('Respon Cepat');
            $table->string('chip_1_value')->default('≤ 2 Jam');
            $table->string('chip_2_icon')->default('clock-fill');
            $table->string('chip_2_text')->default('Layanan');
            $table->string('chip_2_value')->default('Sen–Jum, 08.00–17.00');
            $table->string('chip_3_icon')->default('whatsapp');
            $table->string('chip_3_text')->default('WA 24 Jam');
            $table->string('chip_3_value')->default('Khusus Order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_hero_settings');
    }
};
