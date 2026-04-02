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
        Schema::table('product_ctas', function (Blueprint $table) {
            $table->string('primary_button_icon')->nullable()->after('primary_button_url');
            $table->string('secondary_button_icon')->nullable()->after('secondary_button_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_ctas', function (Blueprint $table) {
            $table->dropColumn(['primary_button_icon', 'secondary_button_icon']);
        });
    }
};
