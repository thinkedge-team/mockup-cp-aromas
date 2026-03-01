<?php

namespace Database\Seeders;

use App\Models\AboutCtaSetting;
use Illuminate\Database\Seeder;

class AboutCtaSettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutCtaSetting::create([
            'headline'     => 'Siap Bergabung Bersama Keluarga AROMAS?',
            'subtext'      => 'Jadilah bagian dari jutaan keluarga Indonesia yang mempercayai AROMAS setiap hari.',
            'button_1_text' => 'Lihat Produk',
            'button_1_url'  => '/#products',
            'button_2_text' => 'Hubungi Kami',
            'button_2_url'  => '/#contact',
            'is_active'    => true,
        ]);
    }
}
