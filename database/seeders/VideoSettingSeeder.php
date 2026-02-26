<?php

namespace Database\Seeders;

use App\Models\VideoSetting;
use Illuminate\Database\Seeder;

class VideoSettingSeeder extends Seeder
{
    public function run(): void
    {
        VideoSetting::create([
            'section_title' => 'Proses Produksi AROMAS',
            'video_url' => '', // Empty by default - add your own YouTube video URL from CMS
            'is_active' => true,
        ]);
    }
}
