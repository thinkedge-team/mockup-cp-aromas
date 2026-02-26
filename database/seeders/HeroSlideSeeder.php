<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSlide::create([
            'order' => 1,
            'badge_icon' => 'bi-award-fill',
            'badge_text' => 'Premium Quality',
            'title' => 'Minyak Goreng',
            'title_gradient' => 'AROMAS',
            'description' => 'Hadirkan cita rasa terbaik untuk masakan keluarga dengan minyak goreng sawit berkualitas premium. Jernih, sehat, dan tahan panas tinggi.',
            'pills' => [
                ['text' => 'Rendah Kolesterol'],
                ['text' => 'Halal MUI'],
                ['text' => 'BPOM Certified'],
            ],
            'primary_button_text' => 'Lihat Produk',
            'primary_button_url' => '#products',
            'secondary_button_text' => 'Tentang Kami',
            'secondary_button_url' => '/about',
            'trust_items' => [
                ['number' => '15+', 'label' => 'Tahun Pengalaman'],
                ['number' => '1Jt+', 'label' => 'Pelanggan Setia'],
                ['number' => '500+', 'label' => 'Mitra Distribusi'],
            ],
            'floating_cards' => [
                ['icon' => 'bi-heart-pulse-fill', 'title' => 'Sehat', 'subtitle' => 'Rendah Lemak'],
                ['icon' => 'bi-fire', 'title' => 'Tahan Panas', 'subtitle' => 'Anti Gosong'],
                ['icon' => 'bi-droplet-fill', 'title' => 'Jernih', 'subtitle' => '100% Murni'],
            ],
            'is_active' => true,
        ]);

        HeroSlide::create([
            'order' => 2,
            'badge_icon' => 'bi-building-fill',
            'badge_text' => 'Kemitraan B2B',
            'title' => 'Solusi Industri',
            'title_gradient' => 'Terpercaya',
            'description' => 'Pasokan minyak goreng premium untuk restoran, hotel, katering & industri makanan dengan harga kompetitif dan kualitas terjamin.',
            'pills' => [
                ['text' => 'Harga Grosir'],
                ['text' => 'Pengiriman Cepat'],
                ['text' => 'Kontrak Fleksibel'],
            ],
            'primary_button_text' => 'Mulai Kemitraan',
            'primary_button_url' => '/partnership',
            'secondary_button_text' => 'Hubungi Kami',
            'secondary_button_url' => '/contact',
            'trust_items' => [
                ['number' => '500+', 'label' => 'Mitra Aktif'],
                ['number' => '34', 'label' => 'Provinsi Terjangkau'],
                ['number' => '24/7', 'label' => 'Layanan Pelanggan'],
            ],
            'floating_cards' => [
                ['icon' => 'bi-truck-front-fill', 'title' => 'Pengiriman', 'subtitle' => 'Ke Seluruh RI'],
                ['icon' => 'bi-box-seam-fill', 'title' => 'Bulk Order', 'subtitle' => 'Min. 100 Liter'],
                ['icon' => 'bi-shield-check-fill', 'title' => 'Garansi', 'subtitle' => 'Kualitas 100%'],
            ],
            'is_active' => true,
        ]);

        HeroSlide::create([
            'order' => 3,
            'badge_icon' => 'bi-patch-check-fill',
            'badge_text' => 'Bersertifikat Resmi',
            'title' => 'Standar Keamanan',
            'title_gradient' => 'Tertinggi',
            'description' => 'Setiap tetes AROMAS melalui quality control ketat bersertifikasi internasional—aman untuk seluruh keluarga Indonesia.',
            'pills' => [
                ['text' => 'ISO 22000:2018'],
                ['text' => 'BPOM RI'],
                ['text' => 'Top Brand 2024'],
            ],
            'primary_button_text' => 'Lihat Produk',
            'primary_button_url' => '/product',
            'secondary_button_text' => 'Penghargaan Kami',
            'secondary_button_url' => '/about',
            'trust_items' => [
                ['number' => '5+', 'label' => 'Sertifikasi'],
                ['number' => '12', 'label' => 'Varian Produk'],
                ['number' => 'A+', 'label' => 'Rating Kualitas'],
            ],
            'floating_cards' => [
                ['icon' => 'bi-award-fill', 'title' => 'Top Brand', 'subtitle' => 'Award 2024'],
                ['icon' => 'bi-patch-check-fill', 'title' => 'Halal MUI', 'subtitle' => 'Tersertifikasi'],
                ['icon' => 'bi-star-fill', 'title' => 'ISO 22000', 'subtitle' => 'Food Safety'],
            ],
            'is_active' => true,
        ]);
    }
}
