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
            $table->json('contact_info')->nullable(); // {phone, email, address}
            $table->json('link_columns')->nullable(); // Repeater: title, links[]
            $table->json('social_links')->nullable(); // {platform, url, icon}
            $table->string('copyright_text')->nullable();
            $table->json('legal_links')->nullable(); // [{label, url}]
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
