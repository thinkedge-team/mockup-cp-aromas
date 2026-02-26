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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('tagline');
            $table->string('badge_text');
            $table->string('image');
            $table->json('images')->nullable(); // Multiple images gallery
            $table->json('sizes')->nullable(); // [{volume, unit, is_popular}]
            $table->json('features')->nullable(); // [{icon, text}]
            $table->string('modal_title');
            $table->string('modal_subtitle');
            $table->json('modal_details')->nullable(); // [{label, value}]
            $table->json('modal_features')->nullable(); // [{icon, text}]
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
        Schema::dropIfExists('products');
    }
};
