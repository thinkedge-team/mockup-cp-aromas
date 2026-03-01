<?php

namespace Database\Seeders;

use App\Models\ContactCtaSetting;
use Illuminate\Database\Seeder;

class ContactCtaSettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactCtaSetting::truncate();
        ContactCtaSetting::create([
            'title'            => 'Masih Punya Pertanyaan?',
            'description'      => 'Tim AROMAS siap membantu Anda 24 jam via WhatsApp atau di jam kerja via telepon dan email.',
            'btn_wa_label'     => 'Chat WhatsApp',
            'btn_wa_number'    => '6281234567890',
            'btn_wa_message'   => 'Halo AROMAS, saya ingin bertanya',
            'btn_phone_label'  => 'Telepon Kami',
            'btn_phone_number' => '02112345678',
        ]);
    }
}
