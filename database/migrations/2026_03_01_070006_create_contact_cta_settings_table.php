<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_cta_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Masih Punya Pertanyaan?');
            $table->text('description')->nullable();
            $table->string('btn_wa_label')->default('Chat WhatsApp');
            $table->string('btn_wa_number')->default('6281234567890');
            $table->string('btn_wa_message')->nullable();
            $table->string('btn_phone_label')->default('Telepon Kami');
            $table->string('btn_phone_number')->default('02112345678');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_cta_settings');
    }
};
