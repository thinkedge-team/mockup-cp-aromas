<?php

namespace Database\Seeders;

use App\Models\AboutCoreValue;
use Illuminate\Database\Seeder;

class AboutCoreValueSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            ['icon' => 'award', 'title' => 'Kualitas', 'description' => 'Kami tidak pernah berkompromi soal kualitas. Hanya yang terbaik yang sampai ke tangan konsumen.', 'sort_order' => 1],
            ['icon' => 'shield-check', 'title' => 'Integritas', 'description' => 'Kejujuran dan transparansi adalah fondasi kepercayaan pelanggan kepada kami.', 'sort_order' => 2],
            ['icon' => 'lightbulb', 'title' => 'Inovasi', 'description' => 'Terus berinovasi menciptakan produk yang lebih sehat dan proses yang lebih efisien.', 'sort_order' => 3],
            ['icon' => 'tree', 'title' => 'Keberlanjutan', 'description' => 'Berkomitmen menjaga kelestarian alam demi masa depan generasi mendatang.', 'sort_order' => 4],
        ];

        foreach ($values as $value) {
            AboutCoreValue::create(array_merge($value, ['is_active' => true]));
        }
    }
}
