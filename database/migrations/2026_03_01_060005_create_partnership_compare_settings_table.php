<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_compare_settings', function (Blueprint $table) {
            $table->id();
            $table->string('section_title')->default('Bandingkan Program Kemitraan');
            $table->text('section_subtitle')->nullable();
            $table->json('rows')->nullable()->comment('Array of {feature, franchise_val, distributor_val, agen_val, maklon_val, implan_val}');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_compare_settings');
    }
};
