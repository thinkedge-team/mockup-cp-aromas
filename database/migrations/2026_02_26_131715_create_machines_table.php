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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('machine_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('tagline');
            $table->integer('unit_count')->default(1);
            $table->string('capacity_badge');
            $table->json('images')->nullable(); // [{url, order, is_primary}]
            $table->json('specs')->nullable(); // [{label, value, order}]
            $table->json('components')->nullable(); // [{name, order}]
            $table->string('modal_title')->nullable();
            $table->string('modal_subtitle')->nullable();
            $table->text('modal_description')->nullable();
            $table->text('whatsapp_message')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
