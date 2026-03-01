<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_vm_settings', function (Blueprint $table) {
            $table->id();
            $table->string('section_title_main')->default('Visi & Misi');
            $table->text('section_subtitle')->nullable();
            $table->text('vision_text');
            $table->json('mission_items')->nullable(); // [{text}] unlimited
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_vm_settings');
    }
};
