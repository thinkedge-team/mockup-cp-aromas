<?php

namespace Database\Seeders;

use App\Models\MachineCta;
use Illuminate\Database\Seeder;

class MachineCtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MachineCta::create([
            'title' => 'Ingin Tahu Lebih Lanjut Tentang Fasilitas Produksi Kami?',
            'description' => 'Jadwalkan kunjungan pabrik atau hubungi tim teknis kami untuk informasi lebih detail.',
            'primary_button_text' => 'Jadwalkan Kunjungan',
            'primary_button_url' => 'https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20kunjungan%20pabrik',
            'secondary_button_text' => 'Kirim Pertanyaan',
            'secondary_button_url' => '/contact',
            'is_active' => true,
        ]);
    }
}
