<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('category', ['retail', 'horeca', 'industri', 'catering']);
            $table->string('subcategory')->nullable(); // "Minimarket", "Hotel ★★★★★", etc.
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->string('products')->nullable();
            $table->string('partnership_since')->nullable();
            $table->string('volume')->nullable();
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->json('tags')->nullable(); // Array of tag strings
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_partners');
    }
};
