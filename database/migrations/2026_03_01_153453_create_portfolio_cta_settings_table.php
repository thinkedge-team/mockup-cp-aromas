<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_cta_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_emphasis')->nullable();
            $table->text('description')->nullable();
            $table->json('buttons')->nullable(); // [{label, url, icon, style}]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_cta_settings');
    }
};
