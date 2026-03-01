<?php

namespace Database\Seeders;

use App\Models\AboutStorySetting;
use Illuminate\Database\Seeder;

class AboutStorySettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutStorySetting::create([
            'badge_text'       => 'Sejarah Kami',
            'title_main'       => 'Kisah di Balik Merek',
            'title_italic'     => 'AROMAS',
            'lead_paragraph'   => 'Berawal dari sebuah pabrik kecil di Jakarta pada tahun 2009, AROMAS tumbuh menjadi salah satu produsen minyak goreng sawit terpercaya di Indonesia.',
            'body_paragraph_1' => 'Dengan visi yang kuat untuk menghadirkan produk berkualitas tinggi yang dapat dinikmati setiap keluarga, kami terus berinovasi dalam proses produksi, mulai dari pemilihan bahan baku kelapa sawit pilihan hingga teknologi penyulingan multi-tahap yang menghasilkan minyak jernih, tidak berbau, dan kaya vitamin E alami.',
            'body_paragraph_2' => 'Kini AROMAS telah hadir di seluruh 34 provinsi di Indonesia, bermitra dengan lebih dari 500 distributor dan dipercaya oleh lebih dari 1 juta keluarga sebagai pilihan utama minyak goreng mereka.',
            'story_image'      => null,
            'founded_year'     => 2009,
            'founded_label'    => 'Tahun Berdiri AROMAS',
            'cert_badge_text'  => 'ISO 22000',
            'pills'            => [
                ['icon' => 'award-fill', 'text' => 'Berdiri Tahun 2009'],
                ['icon' => 'patch-check-fill', 'text' => 'Bersertifikat Halal MUI'],
                ['icon' => 'shield-check', 'text' => 'Teregistrasi BPOM'],
                ['icon' => 'tree-fill', 'text' => 'Produksi Berkelanjutan'],
            ],
            'is_active'        => true,
        ]);
    }
}
