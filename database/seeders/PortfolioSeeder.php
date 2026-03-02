<?php

namespace Database\Seeders;

use App\Models\PortfolioCtaSetting;
use App\Models\PortfolioImpactStat;
use App\Models\PortfolioKeunggulan;
use App\Models\PortfolioMitraLogo;
use App\Models\PortfolioPartner;
use App\Models\PortfolioSetting;
use App\Models\PortfolioTestimonial;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Portfolio Settings
        PortfolioSetting::create([
            'badge_text' => 'Portofolio Kemitraan',
            'badge_icon' => 'bi-briefcase-fill',
            'title' => 'Dipercaya Ribuan Mitra',
            'title_emphasis' => 'Di Seluruh Indonesia',
            'description' => 'Dari UMKM hingga korporasi besar — AROMAS bangga menjadi bagian dari ribuan kisah sukses mitra bisnis kami di berbagai sektor industri.',
            'stats' => [
                ['icon' => 'bi-people-fill', 'number' => '1Jt+', 'label' => 'Pelanggan Setia'],
                ['icon' => 'bi-building', 'number' => '500+', 'label' => 'Mitra Distribusi'],
                ['icon' => 'bi-geo-alt-fill', 'number' => '34', 'label' => 'Provinsi Terjangkau'],
                ['icon' => 'bi-star-fill', 'number' => '4.9/5', 'label' => 'Rating Kepuasan'],
            ],
            'is_active' => true,
        ]);

        // Portfolio Partners - Retail
        PortfolioPartner::create([
            'name' => 'Mart 88 Group',
            'slug' => 'mart-88-group',
            'category' => 'retail',
            'subcategory' => 'Minimarket Modern',
            'tagline' => 'Jaringan Minimarket Modern Terkemuka',
            'description' => 'Mart 88 membutuhkan pasokan minyak goreng berkualitas dengan harga kompetitif untuk lini produk private label mereka. AROMAS hadir memberikan solusi supply chain yang andal dengan ketepatan pengiriman 99% dan kualitas produk yang konsisten di setiap batch produksi.',
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
            'description' => 'Sejak beralih ke AROMAS, pelanggan saya lebih puas karena minyaknya bening dan tidak cepat hitam. Penjualan minyak goreng di toko kami meningkat 30% berkat kualitas yang stabil dan harga yang bersaing. Pengiriman juga selalu tepat waktu sehingga stok aman.',
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
            'description' => 'Dalam bisnis e-commerce, kecepatan dan ketahanan kemasan sangat krusial. Kemasan botol AROMAS sangat kokoh dan aman untuk pengiriman jarak jauh, meminimalisir risiko kebocoran hingga 0%. Desain kemasan yang premium juga terlihat menarik di katalog aplikasi kami.',
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

        // Portfolio Partners - Horeca
        PortfolioPartner::create([
            'name' => 'Grand Hotel Horizon',
            'slug' => 'grand-hotel-horizon',
            'category' => 'horeca',
            'subcategory' => 'Hotel ★★★★★',
            'tagline' => 'Hotel Bintang 5 Standar Internasional',
            'description' => 'Kualitas minyak AROMAS sangat konsisten dari batch ke batch. Titik asap yang tinggi membuat hasil gorengan kami renyah sempurna tanpa berminyak berlebih. Kami sangat merekomendasikan AROMAS untuk kebutuhan dapur profesional. — Chef Rudi Santoso, Executive Chef Grand Hotel Horizon.',
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
            'description' => 'Kopi dan camilan adalah pasangan tak terpisahkan. AROMAS memberikan tekstur gorengan yang ringan dan crunch yang tahan lama untuk menu side dish kami, sempurna untuk mendampingi menu kopi signature kami. Tidak berminyak dan tidak mengubah rasa asli bahan makanan.',
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
            'description' => 'Mengelola food court dengan puluhan tenant membutuhkan standar bahan baku yang seragam. AROMAS menjadi solusi satu pintu untuk kebutuhan minyak goreng semua tenant kami dengan sistem distribusi yang efisien. Kebersihan dan kualitas makanan tenant jadi lebih terjaga.',
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

        // Portfolio Partners - Industri
        PortfolioPartner::create([
            'name' => 'IndoSnack Factory',
            'slug' => 'indosnack-factory',
            'category' => 'industri',
            'subcategory' => 'Manufaktur Makanan',
            'tagline' => 'Produsen Makanan Ringan Ekspor',
            'description' => 'Kami menyediakan formulasi khusus dengan antioksidan tambahan untuk memperpanjang shelf-life produk snack mereka, sesuai standar ekspor ke negara-negara Asia Tenggara. Konsistensi kualitas antar batch menjadi kunci keberhasilan kemitraan ini selama 7 tahun.',
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
            'description' => 'Tekstur mie yang kenyal dan tidak lengket sangat dipengaruhi oleh kualitas minyak saat proses produksi. AROMAS memberikan formulasi khusus yang membuat produk mie kami memiliki daya simpan lebih lama dan tekstur yang pas. Layanan teknis mereka juga sangat membantu.',
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
            'description' => 'Awalnya saya ragu bisa ekspor. Tapi keripik singkong kami kini bisa tembus pasar Singapura karena AROMAS menjamin sertifikasi halal dan keamanan pangan yang diakui internasional. Hasil gorengan juga lebih garing, warnanya cantik, dan tidak berbau tengik meski disimpan lama.',
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

        // Portfolio Partners - Catering
        PortfolioPartner::create([
            'name' => 'Catering Nusantara',
            'slug' => 'catering-nusantara',
            'category' => 'catering',
            'subcategory' => 'Katering Premium',
            'tagline' => 'Spesialis Katering Pernikahan & Korporat',
            'description' => 'Supply selalu tepat waktu tanpa pernah ada kendala meski di musim puncak pernikahan. Tim sales AROMAS sangat responsif dalam memberikan solusi ketika ada kebutuhan mendadak untuk event besar dengan ratusan hingga ribuan tamu undangan.',
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
            'description' => 'Mengelola kantin untuk 12 perusahaan BUMN dan swasta membutuhkan partner yang andal. AROMAS selalu tepat waktu dengan kualitas konsisten. Sistem pembayaran yang fleksibel dan layanan purna jual yang responsif membuat kami nyaman bermitra jangka panjang.',
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
            'description' => 'AROMAS tidak hanya menjual produk, tapi juga peduli pada dampak sosial. Mereka memberikan harga khusus untuk program makan bergizi kami yang menjangkau 5.000 penerima manfaat di 8 kota. Kualitas minyak yang baik berarti makanan yang lebih sehat untuk komunitas yang kami layani.',
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

        // Testimonials
        PortfolioTestimonial::create([
            'author_name' => 'Chef Rudi Santoso',
            'author_role' => 'Executive Chef, Grand Hotel Horizon',
            'author_avatar' => 'https://images.unsplash.com/photo-1566492031773-4f4e44671857?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Kualitas minyak AROMAS sangat konsisten. Titik asap tinggi membuat gorengan kami renyah sempurna. Sudah 5 tahun setia memakai AROMAS!',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Sari Dewi',
            'author_role' => 'Owner, Catering Nusantara',
            'author_avatar' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Supply selalu tepat waktu, tidak pernah ada kendala. Tim sales AROMAS sangat responsif dan profesional. Sangat direkomendasikan!',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Budi Hartono',
            'author_role' => 'Direktur Produksi, IndoSnack Factory',
            'author_avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Sebagai produsen snack ekspor, kami butuh minyak dengan kualitas stabil. AROMAS memenuhi standar kami bahkan melebihi ekspektasi.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Ratna Kusuma',
            'author_role' => 'Pemilik, Toko Kelontong Berkah',
            'author_avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop&crop=face',
            'rating' => 5.0,
            'testimonial_text' => 'Beralih ke AROMAS adalah keputusan terbaik untuk bisnis kami. Penjualan minyak goreng naik 30% karena pelanggan puas dengan kualitasnya.',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        PortfolioTestimonial::create([
            'author_name' => 'Andi Wijaya',
            'author_role' => 'CEO, NusaMart Online',
            'author_avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face',
            'rating' => 4.5,
            'testimonial_text' => 'Kemasan AROMAS sangat kokoh, zero kebocoran dalam pengiriman e-commerce. Desain kemasan premium juga meningkatkan daya tarik produk di katalog digital kami.',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        // Impact Stats
        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=160&fit=crop',
            'number' => '15',
            'label' => 'Tahun Pengalaman',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=300&h=160&fit=crop',
            'number' => '500',
            'label' => 'Mitra Distribusi',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=300&h=160&fit=crop',
            'number' => '34',
            'label' => 'Provinsi Terjangkau',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=300&h=160&fit=crop',
            'number' => '1000000',
            'label' => 'Pelanggan Setia',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Keunggulan
        PortfolioKeunggulan::create([
            'icon' => 'bi-award-fill',
            'title' => 'Halal & Bersertifikat',
            'description' => 'Sertifikasi Halal MUI, BPOM RI, dan ISO 22000 — jaminan keamanan pangan tanpa kompromi.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioKeunggulan::create([
            'icon' => 'bi-truck',
            'title' => 'Pengiriman Tepat Waktu',
            'description' => 'Jaringan logistik luas dengan tingkat ketepatan pengiriman 99% ke seluruh Indonesia.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioKeunggulan::create([
            'icon' => 'bi-headset',
            'title' => 'Dukungan 24/7',
            'description' => 'Tim sales dan customer service siap membantu pertanyaan, pesanan, dan solusi bisnis Anda.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        PortfolioKeunggulan::create([
            'icon' => 'bi-graph-up-arrow',
            'title' => 'Harga Kompetitif',
            'description' => 'Program harga khusus untuk mitra volume tinggi dengan kontrak jangka panjang yang menguntungkan.',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Mitra Logos
        PortfolioMitraLogo::create(['name' => 'Indomaret', 'logo' => null, 'url' => null, 'sort_order' => 1, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Alfamart', 'logo' => null, 'url' => null, 'sort_order' => 2, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Hypermart', 'logo' => null, 'url' => null, 'sort_order' => 3, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Giant', 'logo' => null, 'url' => null, 'sort_order' => 4, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Superindo', 'logo' => null, 'url' => null, 'sort_order' => 5, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Tokopedia', 'logo' => null, 'url' => null, 'sort_order' => 6, 'is_active' => true]);

        // CTA Settings
        PortfolioCtaSetting::create([
            'title' => 'Siap Bergabung',
            'title_emphasis' => 'Bersama Mitra AROMAS?',
            'description' => 'Hubungi tim kami sekarang dan dapatkan penawaran harga khusus sesuai volume kebutuhan bisnis Anda.',
            'buttons' => [
                ['label' => 'Chat via WhatsApp', 'url' => 'https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20menjadi%20mitra', 'icon' => 'bi-whatsapp', 'style' => 'white'],
                ['label' => 'Kirim Pesan', 'url' => '/contact', 'icon' => 'bi-envelope-fill', 'style' => 'outline'],
            ],
            'is_active' => true,
        ]);
    }
}
