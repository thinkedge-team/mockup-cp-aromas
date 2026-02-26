<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'icon' => 'bi-droplet-half',
            'label' => 'Kemasan Primer',
            'title' => 'Botol',
            'slug' => 'botol',
            'description' => 'Kemasan botol plastik HDPE berkualitas tinggi — jernih, ringan, dan mudah dituang. Ideal untuk konsumsi rumah tangga harian dengan berbagai pilihan ukuran dari 200 ml hingga 2.000 ml untuk menyesuaikan kebutuhan keluarga Anda.',
            'order' => 1,
            'is_active' => true,
        ]);

        ProductCategory::create([
            'icon' => 'bi-bucket-fill',
            'label' => 'Kemasan Sekunder',
            'title' => 'Jeriken / Refill',
            'slug' => 'jeriken',
            'description' => 'Kemasan jeriken yang praktis dan ekonomis untuk keluarga besar. Desain ergonomis dengan pegangan kuat, mudah disimpan dan dituang. Tersedia dalam ukuran 5 hingga 20 liter untuk kebutuhan bulanan Anda.',
            'order' => 2,
            'is_active' => true,
        ]);

        ProductCategory::create([
            'icon' => 'bi-box-fill',
            'label' => 'Kemasan Industri',
            'title' => 'BIB (Bag in Box)',
            'slug' => 'bib',
            'description' => 'Kemasan BIB (Bag in Box) dirancang khusus untuk kebutuhan industri dan komersial. Sistem tap memudahkan pengambilan, higienis, dan tahan lama. Tersedia dalam ukuran 15 hingga 25 liter untuk restoran, hotel, dan katering.',
            'order' => 3,
            'is_active' => true,
        ]);
    }
}
