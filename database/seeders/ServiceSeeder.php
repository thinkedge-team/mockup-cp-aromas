<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'icon' => 'bi-box-seam',
            'title' => 'Distribusi Nasional',
            'description' => 'Jaringan distribusi yang luas mencakup seluruh Indonesia, memastikan produk AROMAS tersedia di berbagai toko dan supermarket terdekat Anda.',
            'order' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'icon' => 'bi-building',
            'title' => 'Kemitraan B2B',
            'description' => 'Program kemitraan khusus untuk restoran, hotel, katering, dan industri makanan dengan harga kompetitif dan pasokan terjamin.',
            'order' => 2,
            'is_active' => true,
        ]);

        Service::create([
            'icon' => 'bi-shield-check',
            'title' => 'Jaminan Kualitas',
            'description' => 'Setiap produk AROMAS melalui proses quality control ketat dengan sertifikasi BPOM, Halal MUI, dan standar ISO untuk menjamin keamanan konsumen.',
            'order' => 3,
            'is_active' => true,
        ]);

        Service::create([
            'icon' => 'bi-headset',
            'title' => 'Layanan Pelanggan',
            'description' => 'Tim customer service yang responsif siap membantu pertanyaan, keluhan, dan saran Anda melalui berbagai channel komunikasi 24/7.',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
