<?php

namespace Database\Seeders;

use App\Models\Benefit;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    public function run(): void
    {
        Benefit::create([
            'icon' => 'bi-heart-pulse',
            'title' => 'Rendah Kolesterol',
            'description' => 'Diformulasi khusus dengan kandungan lemak jenuh yang rendah untuk menjaga kesehatan jantung dan pembuluh darah keluarga Anda.',
            'order' => 1,
            'is_active' => true,
        ]);

        Benefit::create([
            'icon' => 'bi-brightness-high',
            'title' => 'Jernih & Tidak Berbau',
            'description' => 'Proses penyulingan multi-tahap menghasilkan minyak goreng yang jernih, tidak berbau, dan tidak mengubah rasa asli masakan Anda.',
            'order' => 2,
            'is_active' => true,
        ]);

        Benefit::create([
            'icon' => 'bi-fire',
            'title' => 'Tahan Panas Tinggi',
            'description' => 'Titik asap tinggi memungkinkan penggorengan berulang tanpa cepat menghitam, lebih hemat dan ekonomis untuk rumah tangga.',
            'order' => 3,
            'is_active' => true,
        ]);

        Benefit::create([
            'icon' => 'bi-shield-plus',
            'title' => 'Kaya Vitamin E',
            'description' => 'Mengandung vitamin E alami sebagai antioksidan yang membantu menjaga kesehatan kulit dan meningkatkan daya tahan tubuh.',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
