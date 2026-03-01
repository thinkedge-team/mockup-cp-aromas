<?php

namespace Database\Seeders;

use App\Models\AboutVmSetting;
use Illuminate\Database\Seeder;

class AboutVmSettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutVmSetting::create([
            'section_title_main' => 'Visi & Misi AROMAS',
            'section_subtitle'   => 'Prinsip yang mengarahkan setiap langkah dan keputusan kami.',
            'vision_text'        => 'Menjadi produsen minyak goreng terkemuka yang dipercaya oleh setiap keluarga Indonesia, dikenal karena kualitas premium, inovasi berkelanjutan, dan kontribusi positif terhadap kesehatan serta kelestarian lingkungan hidup.',
            'mission_items'      => [
                ['text' => 'Memproduksi minyak goreng berkualitas tinggi dengan standar keamanan pangan internasional.'],
                ['text' => 'Mengedepankan inovasi teknologi untuk proses produksi yang ramah lingkungan.'],
                ['text' => 'Meningkatkan kesejahteraan petani sawit dan komunitas sekitar melalui kemitraan yang adil.'],
                ['text' => 'Memberikan edukasi kesehatan kepada konsumen mengenai pola makan yang baik.'],
            ],
            'is_active'          => true,
        ]);
    }
}
