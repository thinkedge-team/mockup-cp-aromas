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
        Schema::table('promo_hero_settings', function (Blueprint $table) {
            $table->json('howto_section')->nullable()->after('is_active');
            $table->json('howto_steps')->nullable()->after('howto_section');
            $table->json('cta_section')->nullable()->after('howto_steps');
            $table->json('cta_buttons')->nullable()->after('cta_section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_hero_settings', function (Blueprint $table) {
            $table->dropColumn(['howto_section', 'howto_steps', 'cta_section', 'cta_buttons']);
        });
    }
};
