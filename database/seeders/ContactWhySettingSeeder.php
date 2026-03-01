<?php

namespace Database\Seeders;

use App\Models\ContactWhySetting;
use Illuminate\Database\Seeder;

class ContactWhySettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactWhySetting::truncate();
        ContactWhySetting::create([
            'label'           => 'Mengapa Hubungi Kami?',
            'title'           => 'Kami Mitra Bisnis',
            'title_highlight' => 'Terpercaya',
            'why_items'       => [
                ['icon' => 'lightning-charge-fill', 'title' => 'Respon Cepat',        'text' => 'rata-rata balasan dalam 2 jam kerja via email, lebih cepat via WhatsApp.'],
                ['icon' => 'percent',               'title' => 'Harga Kompetitif',    'text' => 'kami menawarkan harga khusus untuk pembelian volume besar & kontrak jangka panjang.'],
                ['icon' => 'truck',                 'title' => 'Distribusi Luas',     'text' => 'armada distribusi aktif di 34 provinsi dengan mitra logistik terpercaya.'],
                ['icon' => 'headset',               'title' => 'After-sales Support', 'text' => 'tim kami mendampingi dari pemesanan hingga pengiriman produk tiba.'],
                ['icon' => 'award-fill',            'title' => 'Produk Bersertifikat','text' => 'Halal MUI, BPOM, SNI, dan ISO 22000 untuk ketenangan pikiran Anda.'],
            ],
            'hours_weekday'  => 'Senin – Jumat : 08.00 – 17.00',
            'hours_saturday' => 'Sabtu : 08.00 – 13.00',
            'hours_sunday'   => 'Minggu & Hari Libur : Tutup',
            'hours_wa_note'  => 'WhatsApp Order : 24 Jam / 7 Hari',
            'wa_url'         => 'https://wa.me/6281234567890',
            'instagram_url'  => '#',
            'facebook_url'   => '#',
            'youtube_url'    => '#',
            'tiktok_url'     => '#',
            'email_address'  => 'info@aromas.co.id',
        ]);
    }
}
