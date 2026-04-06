<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_cta_settings', function (Blueprint $table) {
            $table->string('button_1_icon')->default('bi-bag-check-fill')->after('button_1_url');
            $table->string('button_2_icon')->default('bi-chat-dots-fill')->after('button_2_url');
        });
    }

    public function down(): void
    {
        Schema::table('about_cta_settings', function (Blueprint $table) {
            $table->dropColumn(['button_1_icon', 'button_2_icon']);
        });
    }
};
