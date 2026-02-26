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
        Schema::create('product_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('badge_icon')->default('bi-box-seam-fill');
            $table->string('badge_text')->default('Produk Kami');
            $table->string('title');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_heroes');
    }
};
