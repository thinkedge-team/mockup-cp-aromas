<?php

namespace Database\Seeders;

use App\Models\ContactMapSetting;
use Illuminate\Database\Seeder;

class ContactMapSettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactMapSetting::truncate();
        ContactMapSetting::create([
            'section_label'         => 'Lokasi Kami',
            'section_title'         => 'Temukan Kantor & Cabang AROMAS',
            'section_desc'          => 'Kami memiliki kantor pusat di Jakarta dan jaringan cabang di seluruh Indonesia yang siap melayani kebutuhan Anda.',
            'map_embed_url'         => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8197!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNyJTIDEwNsKwNDknMTEuMCJF!5e0!3m2!1sid!2sid!4v1609459200000!5m2!1sid!2sid',
            'map_card_title'        => 'AROMAS Kantor Pusat',
            'map_card_address'      => 'Jl. Industri Raya No. 123, Kawasan Industri, Jakarta 12345',
            'map_card_direction_url'=> 'https://maps.google.com/?q=Jl+Industri+Raya+Jakarta',
            'branch_section_title'  => 'Cabang & Outlet Kami',
        ]);
    }
}
