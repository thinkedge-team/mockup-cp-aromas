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
        Schema::table('mission_sections', function (Blueprint $table) {
            $table->string('middle_text')->nullable()->default('dengan kualitas')->after('highlight_text');
            $table->string('eco_badge_icon')->nullable()->default('bi-check-circle')->after('middle_text');
            $table->string('transition_text')->nullable()->default('dan proses produksi berkelanjutan.')->after('eco_badge_text');
            $table->string('leaf_icon')->nullable()->default('bi-award')->after('mission_text_continued');
            $table->text('final_text')->nullable()->after('leaf_icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mission_sections', function (Blueprint $table) {
            $table->dropColumn(['middle_text', 'eco_badge_icon', 'transition_text', 'leaf_icon', 'final_text']);
        });
    }
};
