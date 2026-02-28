<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_milestones', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('bi-flag-fill');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_milestones');
    }
};
