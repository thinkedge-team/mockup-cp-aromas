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
        Schema::create('promo_howto_sections', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('tag')->default('Cara Klaim');
            $table->string('icon')->default('bi-question-circle-fill');
            $table->string('title')->default('Cara Mendapatkan Promo AROMAS');
            $table->text('description')->nullable();
            $table->json('steps')->nullable(); // [{step_number, title, description, order}]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_howto_sections');
    }
};
