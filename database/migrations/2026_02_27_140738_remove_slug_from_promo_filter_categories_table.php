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
        // SQLite doesn't support dropping columns, so we need to recreate the table
        Schema::dropIfExists('promo_filter_categories_temp');
        Schema::create('promo_filter_categories_temp', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('bi-grid-fill');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Copy data from old table to new table
        $oldData = DB::table('promo_filter_categories')->get(['id', 'name', 'icon', 'sort_order', 'is_active', 'created_at', 'updated_at']);
        foreach ($oldData as $row) {
            DB::table('promo_filter_categories_temp')->insert((array) $row);
        }

        // Drop old table and rename new table
        Schema::dropIfExists('promo_filter_categories');
        Schema::rename('promo_filter_categories_temp', 'promo_filter_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_filter_categories', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
    }
};
