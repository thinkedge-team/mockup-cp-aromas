<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_map_settings', function (Blueprint $table) {
            $table->id();
            $table->string('section_label')->default('Lokasi Kami');
            $table->string('section_title')->default('Temukan Kantor & Cabang AROMAS');
            $table->text('section_desc')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->string('map_card_title')->default('AROMAS Kantor Pusat');
            $table->string('map_card_address')->nullable();
            $table->string('map_card_direction_url')->nullable();
            $table->string('branch_section_title')->default('Cabang & Outlet Kami');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_map_settings');
    }
};
