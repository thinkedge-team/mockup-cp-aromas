<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    public function run(): void
    {
        Award::create([
            'title' => 'Top Brand Award - Kategori Minyak Goreng',
            'organization' => 'Frontier Consulting Group',
            'year' => 2024,
            'status_color' => 'green',
            'order' => 1,
            'is_active' => true,
        ]);

        Award::create([
            'title' => 'Sertifikasi Halal MUI',
            'organization' => 'Majelis Ulama Indonesia',
            'year' => 2024,
            'status_color' => 'green',
            'order' => 2,
            'is_active' => true,
        ]);

        Award::create([
            'title' => 'Indonesia Best Brand Award',
            'organization' => 'SWA Magazine & MARS Research',
            'year' => 2023,
            'status_color' => 'yellow',
            'order' => 3,
            'is_active' => true,
        ]);

        Award::create([
            'title' => 'ISO 22000:2018 - Food Safety Management',
            'organization' => 'International Organization for Standardization',
            'year' => 2023,
            'status_color' => 'green',
            'order' => 4,
            'is_active' => true,
        ]);

        Award::create([
            'title' => 'Sertifikasi BPOM RI',
            'organization' => 'Badan Pengawas Obat dan Makanan',
            'year' => 2022,
            'status_color' => 'green',
            'order' => 5,
            'is_active' => true,
        ]);
    }
}
