<?php

namespace Database\Seeders;

use App\Models\ContactHeroSetting;
use Illuminate\Database\Seeder;

class ContactHeroSettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactHeroSetting::truncate();
        ContactHeroSetting::create([
            'badge_text'   => 'Kami Siap Membantu',
            'title_line1'  => 'Hubungi Tim',
            'title_highlight' => 'AROMAS',
            'description'  => 'Apakah Anda ingin memesan produk, menjadi mitra distribusi, atau sekadar bertanya? Tim kami siap merespons dengan cepat dan profesional di setiap saluran komunikasi.',
            'chip_1_icon'  => 'lightning-charge-fill',
            'chip_1_text'  => 'Respon Cepat',
            'chip_1_value' => '≤ 2 Jam',
            'chip_2_icon'  => 'clock-fill',
            'chip_2_text'  => 'Layanan',
            'chip_2_value' => 'Sen–Jum, 08.00–17.00',
            'chip_3_icon'  => 'whatsapp',
            'chip_3_text'  => 'WA 24 Jam',
            'chip_3_value' => 'Khusus Order',
        ]);
    }
}
