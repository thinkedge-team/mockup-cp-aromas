<?php

namespace Database\Seeders;

use App\Models\MachineHero;
use Illuminate\Database\Seeder;

class MachineHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MachineHero::create([
            'badge_icon' => 'bi-gear-wide-connected',
            'badge_text' => 'Fasilitas Produksi',
            'title' => 'Mesin Berteknologi Tinggi,',
            'title_gradient' => 'Kualitas Tanpa Kompromi',
            'production_line_image' => 'assets/images/machine line.png',
            'hero_stats' => [
                ['icon' => 'bi-lightning-charge-fill', 'number' => '6.000 BPH', 'label' => 'Kapasitas Blowing'],
                ['icon' => 'bi-droplet-fill', 'number' => '12.000 BPH', 'label' => 'Kapasitas Filling'],
                ['icon' => 'bi-award-fill', 'number' => 'ISO 22000', 'label' => 'Sertifikasi Pabrik'],
                ['icon' => 'bi-building-fill-gear', 'number' => '24 Jam', 'label' => 'Operasional Penuh'],
            ],
            'is_active' => true,
        ]);
    }
}
