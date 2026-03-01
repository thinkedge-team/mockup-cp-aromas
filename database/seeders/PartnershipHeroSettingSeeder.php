<?php

namespace Database\Seeders;

use App\Models\PartnershipHeroSetting;
use Illuminate\Database\Seeder;

class PartnershipHeroSettingSeeder extends Seeder
{
    public function run(): void
    {
        PartnershipHeroSetting::firstOrCreate([], [
            'badge_text'   => 'Program Kemitraan AROMAS',
            'title_main'   => 'Tumbuh Bersama Kami,',
            'title_italic' => 'Raih Sukses Bersama',
            'description'  => 'Bergabunglah dengan ribuan mitra sukses AROMAS di seluruh Indonesia. Kami menawarkan lima jalur kemitraan yang fleksibel, menguntungkan, dan didukung penuh oleh tim profesional kami.',
            'wa_number'    => '6281234567890',
            'is_active'    => true,
        ]);
    }
}
