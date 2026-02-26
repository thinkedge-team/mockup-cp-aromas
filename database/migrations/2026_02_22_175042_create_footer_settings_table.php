<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->text('company_description')->nullable();
            $table->json('contact_info')->nullable(); // KeyValue: {phone, email, address, whatsapp}
            $table->json('social_links')->nullable(); // KeyValue: {instagram, facebook, tiktok, youtube}
            $table->string('copyright_text')->nullable();
            $table->json('legal_links')->nullable(); // KeyValue: {privacy, terms}
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
