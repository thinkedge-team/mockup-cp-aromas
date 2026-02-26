<?php

namespace Database\Seeders;

use App\Models\FaqItem;
use Illuminate\Database\Seeder;

class FaqItemSeeder extends Seeder
{
    public function run(): void
    {
        FaqItem::create([
            'question' => 'Apa keunggulan minyak goreng AROMAS dibandingkan dengan merek lain?',
            'answer' => 'Minyak goreng AROMAS diproduksi dengan teknologi modern melalui proses penyulingan multi-tahap yang menghasilkan minyak yang jernih, tidak berbau, dan memiliki titik asap tinggi. AROMAS juga kaya akan vitamin E alami dan telah teruji memiliki kandungan lemak jenuh yang lebih rendah dibandingkan merek lain.',
            'order' => 1,
            'is_active' => true,
        ]);
    }
}
