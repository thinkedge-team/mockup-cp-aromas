<?php

namespace Database\Seeders;

use App\Models\CapacityStat;
use Illuminate\Database\Seeder;

class CapacityStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CapacityStat::create([
            'icon' => 'bi-wind',
            'number' => '6.000',
            'title' => 'BPH Blowing',
            'description' => 'Kapasitas produksi botol per jam',
            'order' => 1,
            'is_active' => true,
        ]);

        CapacityStat::create([
            'icon' => 'bi-droplet-fill',
            'number' => '12.000',
            'title' => 'BPH Filling',
            'description' => 'Kapasitas pengisian per jam',
            'order' => 2,
            'is_active' => true,
        ]);

        CapacityStat::create([
            'icon' => 'bi-fire',
            'number' => '50 T',
            'title' => 'Per Hari Refinery',
            'description' => 'Kapasitas penyulingan CPO harian',
            'order' => 3,
            'is_active' => true,
        ]);

        CapacityStat::create([
            'icon' => 'bi-clock-fill',
            'number' => '24/7',
            'title' => 'Operasional',
            'description' => 'Produksi tanpa henti sepanjang tahun',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
