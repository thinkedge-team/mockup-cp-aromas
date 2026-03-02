<?php

namespace App\Filament\Resources\PortfolioPartnerResource\Pages;

use App\Filament\Resources\PortfolioPartnerResource;
use App\Models\PortfolioPartner;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioPartners extends ListRecords
{
    protected static string $resource = PortfolioPartnerResource::class;

    public function mount(): void
    {
        // Seed default partners if none exist
        if (PortfolioPartner::count() === 0) {
            $this->seedDefaultPartners();
        }
    }

    private function seedDefaultPartners(): void
    {
        // Retail Partners
        PortfolioPartner::create([
            'name' => 'Mart 88 Group',
            'slug' => 'mart-88-group',
            'category' => 'retail',
            'subcategory' => 'Minimarket Modern',
            'tagline' => 'Jaringan Minimarket Modern Terkemuka',
            'description' => 'Mart 88 membutuhkan pasokan minyak goreng berkualitas dengan harga kompetitif. AROMAS hadir memberikan solusi supply chain yang andal.',
            'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&h=350&fit=crop',
            'location' => '50+ Cabang Jabodetabek',
            'products' => 'Botol 1L, 2L & Jeriken 5L',
            'partnership_since' => '2021',
            'volume' => '> 10.000 L/bulan',
            'rating' => 5.0,
            'tags' => ['Supply Rutin', 'Private Label'],
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'Toko Kelontong Berkah',
            'slug' => 'toko-kelontong-berkah',
            'category' => 'retail',
            'subcategory' => 'Grosir Tradisional',
            'tagline' => 'Grosir sembako terpercaya sejak 2015',
            'description' => 'Sejak beralih ke AROMAS, pelanggan lebih puas karena minyaknya bening dan tidak cepat hitam.',
            'image' => 'https://images.unsplash.com/photo-1604719312566-8912e9227f6a?w=600&h=350&fit=crop',
            'location' => 'Pasar Induk Kramat Jati',
            'products' => 'Semua varian ukuran',
            'partnership_since' => '2015',
            'volume' => '> 5.000 L/bulan',
            'rating' => 4.9,
            'tags' => ['Grosir', 'Tradisional'],
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'NusaMart Online',
            'slug' => 'nusamart-online',
            'category' => 'retail',
            'subcategory' => 'E-Commerce',
            'tagline' => 'Platform belanja groceries digital',
            'description' => 'Kemasan AROMAS sangat kokoh dan aman untuk pengiriman jarak jauh.',
            'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=350&fit=crop',
            'location' => 'Layanan 15 Kota Besar',
            'products' => 'Botol 1L & 2L',
            'partnership_since' => '2022',
            'volume' => '> 8.000 L/bulan',
            'rating' => 4.8,
            'tags' => ['Digital', 'Same-Day Delivery'],
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // Horeca Partners
        PortfolioPartner::create([
            'name' => 'Grand Hotel Horizon',
            'slug' => 'grand-hotel-horizon',
            'category' => 'horeca',
            'subcategory' => 'Hotel ★★★★★',
            'tagline' => 'Hotel Bintang 5 Standar Internasional',
            'description' => 'Kualitas minyak AROMAS sangat konsisten. Titik asap tinggi membuat hasil gorengan renyah sempurna.',
            'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&h=350&fit=crop',
            'location' => 'Bandung & Jakarta',
            'products' => 'Jeriken 18L & BIB 20L',
            'partnership_since' => '2019',
            'volume' => '> 15.000 L/bulan',
            'rating' => 5.0,
            'tags' => ['Premium', 'Horeca'],
            'sort_order' => 4,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'Cafe Senja Group',
            'slug' => 'cafe-senja-group',
            'category' => 'horeca',
            'subcategory' => 'Coffee Shop Chain',
            'tagline' => 'Chain Coffee Shop Kekinian Nasional',
            'description' => 'AROMAS memberikan tekstur gorengan yang ringan dan crunch yang tahan lama.',
            'image' => 'https://images.unsplash.com/photo-1559339352-73130fa2718e?w=600&h=350&fit=crop',
            'location' => '20 Outlet Nasional',
            'products' => 'Jeriken 5L',
            'partnership_since' => '2022',
            'volume' => '> 3.000 L/bulan',
            'rating' => 4.9,
            'tags' => ['F&B', 'Modern'],
            'sort_order' => 5,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'Kelapa Muda Food Hall',
            'slug' => 'kelapa-muda-food-hall',
            'category' => 'horeca',
            'subcategory' => 'Food Court',
            'tagline' => 'Pusat Kuliner Modern Skala Besar',
            'description' => 'AROMAS menjadi solusi satu pintu untuk kebutuhan minyak goreng semua tenant kami.',
            'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&h=350&fit=crop',
            'location' => '5 Mall Terkemuka Jakarta',
            'products' => 'BIB 20L & Jeriken 18L',
            'partnership_since' => '2020',
            'volume' => '> 12.000 L/bulan',
            'rating' => 4.7,
            'tags' => ['Food Hall', 'High Volume'],
            'sort_order' => 6,
            'is_active' => true,
        ]);

        // Industri Partners
        PortfolioPartner::create([
            'name' => 'IndoSnack Factory',
            'slug' => 'indosnack-factory',
            'category' => 'industri',
            'subcategory' => 'Manufaktur Makanan',
            'tagline' => 'Produsen Makanan Ringan Ekspor',
            'description' => 'Kami menyediakan formulasi khusus dengan antioksidan tambahan untuk memperpanjang shelf-life produk.',
            'image' => 'https://images.unsplash.com/photo-1565514020176-db7936a5fa93?w=600&h=350&fit=crop',
            'location' => 'Kawasan Industri Cikarang',
            'products' => 'BIB 20L & Tangki Curah',
            'partnership_since' => '2018',
            'volume' => '20 Ton/bulan',
            'rating' => 5.0,
            'tags' => ['Industri Besar', 'Ekspor'],
            'sort_order' => 7,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'PT Mie Nusantara',
            'slug' => 'pt-mie-nusantara',
            'category' => 'industri',
            'subcategory' => 'Manufaktur Makanan',
            'tagline' => 'Produsen Mie & Bakmi Lokal Terkemuka',
            'description' => 'AROMAS memberikan formulasi khusus yang membuat produk mie memiliki daya simpan lebih lama.',
            'image' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&h=350&fit=crop',
            'location' => 'Bekasi, Jawa Barat',
            'products' => 'BIB 20L & Tangki Curah',
            'partnership_since' => '2017',
            'volume' => '15 Ton/bulan',
            'rating' => 4.8,
            'tags' => ['B2B', 'Food Processing'],
            'sort_order' => 8,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'UMKM Keripik Ibu Sri',
            'slug' => 'umkm-keripik-ibu-sri',
            'category' => 'industri',
            'subcategory' => 'UMKM Kreatif',
            'tagline' => 'Keripik Artisan Rumahan Skala Ekspor',
            'description' => 'Keripik singkong kami kini bisa tembus pasar Singapura karena AROMAS menjamin sertifikasi halal.',
            'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&h=350&fit=crop',
            'location' => 'Surabaya, Jawa Timur',
            'products' => 'Jeriken 18L',
            'partnership_since' => '2020',
            'volume' => '2 Ton/bulan',
            'rating' => 4.9,
            'tags' => ['UMKM', 'Artisan'],
            'sort_order' => 9,
            'is_active' => true,
        ]);

        // Catering Partners
        PortfolioPartner::create([
            'name' => 'Catering Nusantara',
            'slug' => 'catering-nusantara',
            'category' => 'catering',
            'subcategory' => 'Katering Premium',
            'tagline' => 'Spesialis Katering Pernikahan & Korporat',
            'description' => 'Supply selalu tepat waktu meski di musim puncak pernikahan.',
            'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&h=350&fit=crop',
            'location' => 'Jabodetabek Area',
            'products' => 'Jeriken 18L & BIB 20L',
            'partnership_since' => '2020',
            'volume' => '500 porsi/hari',
            'rating' => 5.0,
            'tags' => ['Wedding', 'Corporate'],
            'sort_order' => 10,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'Dapur Karyawan Sejahtera',
            'slug' => 'dapur-karyawan-sejahtera',
            'category' => 'catering',
            'subcategory' => 'Kantin Karyawan',
            'tagline' => 'Pengelola Kantin Perusahaan Berskala Besar',
            'description' => 'Mengelola kantin untuk 12 perusahaan BUMN dan swasta membutuhkan partner yang andal.',
            'image' => 'https://images.unsplash.com/photo-1559339352-73130fa2718e?w=600&h=350&fit=crop',
            'location' => '12 Perusahaan BUMN & Swasta',
            'products' => 'BIB 20L & Jeriken 18L',
            'partnership_since' => '2019',
            'volume' => '2.000 porsi/hari',
            'rating' => 4.7,
            'tags' => ['Kantin', 'BUMN'],
            'sort_order' => 11,
            'is_active' => true,
        ]);

        PortfolioPartner::create([
            'name' => 'Yayasan Dapur Sosial',
            'slug' => 'yayasan-dapur-sosial',
            'category' => 'catering',
            'subcategory' => 'Social Enterprise',
            'tagline' => 'Program Makan Bergizi Komunitas',
            'description' => 'AROMAS memberikan harga khusus untuk program makan bergizi komunitas.',
            'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&h=350&fit=crop',
            'location' => '8 Kota di Indonesia',
            'products' => 'Jeriken 18L',
            'partnership_since' => '2021',
            'volume' => '5.000 penerima manfaat',
            'rating' => 5.0,
            'tags' => ['Social', 'Community'],
            'sort_order' => 12,
            'is_active' => true,
        ]);
    }
}
