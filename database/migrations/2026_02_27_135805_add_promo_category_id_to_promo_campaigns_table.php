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
        Schema::table('promo_campaigns', function (Blueprint $table) {
            $table->foreignId('promo_category_id')->nullable()->after('type')->constrained('promo_filter_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_campaigns', function (Blueprint $table) {
            $table->dropForeign(['promo_category_id']);
            $table->dropColumn('promo_category_id');
        });
    }
};
