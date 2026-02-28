<?php

namespace Database\Seeders;

use App\Models\PartnershipCtaSetting;
use Illuminate\Database\Seeder;

class PartnershipCtaSettingSeeder extends Seeder
{
    public function run(): void
    {
        PartnershipCtaSetting::firstOrCreate([], [
            'headline'      => 'Siap Memulai Perjalanan Kemitraan Anda?',
            'subtext'       => 'Bergabunglah dengan 500+ mitra sukses AROMAS di seluruh Indonesia. Konsultasi pertama selalu gratis.',
            'button_1_text' => 'Mulai Konsultasi',
            'wa_number'     => '6281234567890',
            'wa_message'    => 'Halo AROMAS, saya ingin bergabung sebagai mitra',
            'button_2_text' => 'Kirim Formulir',
            'button_2_url'  => '/contact',
            'is_active'     => true,
        ]);
    }
}
