<?php

namespace Database\Seeders;

use App\Models\ProductHero;
use Illuminate\Database\Seeder;

class ProductHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductHero::create([
            'badge_icon' => 'bi-box-seam-fill',
            'badge_text' => 'Produk Kami',
            'title' => "Pilihan Kemasan untuk<br />",
            'title_gradient' => 'Setiap Kebutuhan',
            'description' => 'Dari skala rumah tangga hingga industri, AROMAS hadir dalam tiga varian kemasan — Botol, Jeriken, dan BIB — dengan ukuran yang fleksibel dan kualitas yang konsisten di setiap tetes.',
            'is_active' => true,
        ]);
    }
}
