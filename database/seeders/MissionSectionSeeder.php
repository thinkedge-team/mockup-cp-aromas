<?php

namespace Database\Seeders;

use App\Models\MissionSection;
use Illuminate\Database\Seeder;

class MissionSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MissionSection::create([
            'mission_text' => 'Di AROMAS, kami berkomitmen menghadirkan minyak goreng premium dengan kualitas Terjamin dan proses produksi berkelanjutan.',
            'highlight_text' => 'minyak goreng premium',
            'eco_badge_text' => 'Terjamin',
            'mission_text_continued' => 'Dengan dedikasi terhadap kesehatan konsumen dan kelestarian lingkungan, kami bertujuan menjadi produsen minyak goreng terpercaya di Indonesia.',
            'is_active' => true,
        ]);
    }
}
