<?php

namespace App\Filament\Resources\PortfolioTestimonialResource\Pages;

use App\Filament\Resources\PortfolioTestimonialResource;
use App\Models\PortfolioTestimonial;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioTestimonials extends ListRecords
{
    protected static string $resource = PortfolioTestimonialResource::class;

    public function mount(): void
    {
        if (PortfolioTestimonial::count() === 0) {
            $this->seedDefaultTestimonials();
        }
    }

    private function seedDefaultTestimonials(): void
    {
        PortfolioTestimonial::create([
            'author_name' => 'Chef Rudi Santoso',
            'author_role' => 'Executive Chef, Grand Hotel Horizon',
            'author_avatar' => 'https://images.unsplash.com/photo-1566492031773-4f4e44671857?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Kualitas minyak AROMAS sangat konsisten. Titik asap tinggi membuat gorengan kami renyah sempurna. Sudah 5 tahun setia memakai AROMAS!',
            'category' => 'horeca',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Sari Dewi',
            'author_role' => 'Owner, Catering Nusantara',
            'author_avatar' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Supply selalu tepat waktu, tidak pernah ada kendala. Tim sales AROMAS sangat responsif dan profesional. Sangat direkomendasikan!',
            'category' => 'catering',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Budi Hartono',
            'author_role' => 'Direktur Produksi, IndoSnack Factory',
            'author_avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Sebagai produsen snack ekspor, kami butuh minyak dengan kualitas stabil. AROMAS memenuhi standar kami bahkan melebihi ekspektasi.',
            'category' => 'industri',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Ratna Kusuma',
            'author_role' => 'Pemilik, Toko Kelontong Berkah',
            'author_avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Beralih ke AROMAS adalah keputusan terbaik untuk bisnis kami. Penjualan minyak goreng naik 30% karena pelanggan puas dengan kualitasnya.',
            'category' => 'retail',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Andi Wijaya',
            'author_role' => 'CEO, NusaMart Online',
            'author_avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face',
            'rating' => 4.5,
            'testimonial_text' => 'Kemasan AROMAS sangat kokoh, zero kebocoran dalam pengiriman e-commerce. Desain kemasan premium juga meningkatkan daya tarik produk di katalog digital kami.',
            'category' => 'retail',
            'sort_order' => 5,
            'is_active' => true,
        ]);
    }
}
