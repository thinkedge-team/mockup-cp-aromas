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
        Schema::create('branch_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->string('title_main')->nullable();
            $table->string('title_italic')->nullable();
            $table->text('description')->nullable();
            $table->json('stats')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_hero_settings');
    }
};
