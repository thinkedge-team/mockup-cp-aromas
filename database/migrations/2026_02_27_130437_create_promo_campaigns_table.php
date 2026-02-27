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
        Schema::create('promo_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['ongkir', 'diskon', 'bundling', 'loyalitas', 'grosir', 'flash_sale']);
            $table->string('tagline');
            $table->text('description')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->string('code')->nullable();
            $table->decimal('min_purchase', 12, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->enum('status_badge', ['aktif', 'terbatas', 'flash'])->default('aktif');
            $table->text('whatsapp_message')->nullable();
            $table->json('images')->nullable(); // [{url, order, caption}]
            $table->json('details')->nullable(); // [{label, value, order}]
            $table->json('terms')->nullable(); // [{description, order}]
            $table->string('button_label')->default('Lihat Detail');
            $table->string('button_link')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('is_active');
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_campaigns');
    }
};
