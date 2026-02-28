<?php

namespace Database\Seeders;

use App\Models\AboutHeroSetting;
use Illuminate\Database\Seeder;

class AboutHeroSettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutHeroSetting::create([
            'badge_text'   => 'Perjalanan Kami',
            'title_main'   => 'Menghadirkan Kualitas',
            'title_italic' => 'Terbaik Untuk Indonesia',
            'description'  => 'Sejak didirikan, AROMAS berdedikasi untuk menciptakan produk minyak goreng yang tidak hanya lezat, tetapi juga sehat dan berkelanjutan bagi setiap keluarga.',
            'stats'        => [
                ['value' => '15+', 'label' => 'Tahun Berdiri'],
                ['value' => '1Jt+', 'label' => 'Pelanggan Setia'],
                ['value' => '34', 'label' => 'Provinsi'],
                ['value' => '500+', 'label' => 'Mitra Distribusi'],
            ],
            'is_active'    => true,
        ]);
    }
}
