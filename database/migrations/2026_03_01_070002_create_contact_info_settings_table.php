<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_info_settings', function (Blueprint $table) {
            $table->id();
            // Kartu 1: Alamat
            $table->string('address_title')->default('Kantor Pusat');
            $table->text('address_text')->nullable();
            $table->string('address_maps_url')->nullable();
            $table->string('address_action_label')->default('Lihat di Maps');
            // Kartu 2: Telepon & Fax
            $table->string('phone_title')->default('Telepon & Fax');
            $table->string('phone_office')->nullable();
            $table->string('phone_fax')->nullable();
            $table->string('phone_email')->nullable();
            $table->string('phone_number')->nullable(); // untuk tel: link
            $table->string('phone_action_label')->default('Hubungi Sekarang');
            // Kartu 3: WhatsApp
            $table->string('wa_title')->default('WhatsApp');
            $table->string('wa_sales_label')->default('Sales');
            $table->string('wa_sales_display')->nullable();
            $table->string('wa_sales_number')->nullable(); // untuk wa.me link
            $table->string('wa_dist_label')->default('Distribusi');
            $table->string('wa_dist_display')->nullable();
            $table->string('wa_note')->nullable();
            $table->string('wa_action_label')->default('Chat Sekarang');
            // Kartu 4: Jam Operasional
            $table->string('hours_title')->default('Jam Operasional');
            $table->string('hours_weekday_label')->default('Kantor');
            $table->string('hours_weekday_value')->default('Sen – Jum: 08.00 – 17.00');
            $table->string('hours_saturday_label')->default('Fax');
            $table->string('hours_saturday_value')->default('Sabtu: 08.00 – 13.00');
            $table->string('hours_sunday_value')->default('Minggu: Tutup');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_info_settings');
    }
};
