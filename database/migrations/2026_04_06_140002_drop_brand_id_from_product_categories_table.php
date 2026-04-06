<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            // Drop foreign key constraint first, then drop the column
            if (Schema::hasColumn('product_categories', 'brand_id')) {
                $table->dropForeign(['brand_id']);
                $table->dropColumn('brand_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->foreignId('brand_id')
                ->nullable()
                ->after('id')
                ->constrained('product_brands')
                ->onDelete('set null');
        });
    }
};
