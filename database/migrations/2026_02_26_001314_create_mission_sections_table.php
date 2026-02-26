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
        Schema::create('mission_sections', function (Blueprint $table) {
            $table->id();
            $table->text('mission_text');
            $table->string('highlight_text')->default('minyak goreng premium');
            $table->string('eco_badge_text')->default('Terjamin');
            $table->text('mission_text_continued');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_sections');
    }
};
