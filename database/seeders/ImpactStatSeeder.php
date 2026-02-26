<?php

namespace Database\Seeders;

use App\Models\ImpactStat;
use Illuminate\Database\Seeder;

class ImpactStatSeeder extends Seeder
{
    public function run(): void
    {
        ImpactStat::create([
            'image' => null,
            'number' => '15+',
            'label' => 'Tahun Pengalaman',
            'order' => 1,
            'is_active' => true,
        ]);

        ImpactStat::create([
            'image' => null,
            'number' => '12',
            'label' => 'Varian Produk',
            'order' => 2,
            'is_active' => true,
        ]);

        ImpactStat::create([
            'image' => null,
            'number' => '500+',
            'label' => 'Mitra Distribusi',
            'order' => 3,
            'is_active' => true,
        ]);

        ImpactStat::create([
            'image' => null,
            'number' => '1Jt+',
            'label' => 'Pelanggan Setia',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
