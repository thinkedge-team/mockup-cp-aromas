<?php

namespace Database\Seeders;

use App\Models\ProductCta;
use Illuminate\Database\Seeder;

class ProductCtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCta::create([
            'title' => 'Butuh Informasi Lebih Lanjut?',
            'description' => 'Tim sales kami siap membantu Anda memilih produk yang tepat untuk kebutuhan bisnis atau rumah tangga Anda.',
            'primary_button_text' => 'Chat WhatsApp',
            'primary_button_url' => 'https://wa.me/6281234567890',
            'secondary_button_text' => 'Telepon Kami',
            'secondary_button_url' => 'tel:02112345678',
            'is_active' => true,
        ]);
    }
}
