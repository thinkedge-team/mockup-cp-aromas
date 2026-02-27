<?php

namespace Database\Seeders;

use App\Models\PromoCampaign;
use App\Models\PromoCtaSection;
use App\Models\PromoFilterCategory;
use App\Models\PromoHeroSetting;
use App\Models\PromoHowtoSection;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Filter Categories
        $categories = [
            ['name' => 'Free Ongkir', 'icon' => 'bi-truck', 'sort_order' => 0, 'is_active' => true],
            ['name' => 'Diskon', 'icon' => 'bi-percent', 'sort_order' => 1, 'is_active' => true],
            ['name' => 'Bundling', 'icon' => 'bi-boxes', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'Loyalitas', 'icon' => 'bi-star-fill', 'sort_order' => 3, 'is_active' => true],
            ['name' => 'Grosir', 'icon' => 'bi-building', 'sort_order' => 4, 'is_active' => true],
            ['name' => 'Flash Sale', 'icon' => 'bi-lightning-charge-fill', 'sort_order' => 5, 'is_active' => true],
        ];

        foreach ($categories as $categoryData) {
            PromoFilterCategory::updateOrCreate(
                ['name' => $categoryData['name']],
                $categoryData
            );
        }

        // Get category IDs for linking
        $categoryIds = PromoFilterCategory::pluck('id', 'name')->toArray();

        // Create Hero Settings
        PromoHeroSetting::create([
            'badge_text' => 'Penawaran Terbatas',
            'badge_icon' => 'bi-lightning-charge-fill',
            'title' => 'Promo Spesial <span class="italic text-gradient">AROMAS</span><br />Jangan Sampai Ketinggalan!',
            'description' => 'Dapatkan penawaran terbaik — free ongkir, diskon produk, bundling hemat, hingga program loyalitas eksklusif untuk pelanggan setia AROMAS.',
            'countdown_label' => '⏰ Promo berakhir dalam',
            'countdown_target' => now()->addDays(30),
            'stats' => [
                ['icon' => 'bi-ticket-perforated-fill', 'value' => '6 Promo', 'label' => 'Aktif Saat Ini', 'order' => 0],
                ['icon' => 'bi-geo-alt-fill', 'value' => 'Tangsel & Ciater', 'label' => 'Area Free Ongkir', 'order' => 1],
                ['icon' => 'bi-percent', 'value' => 'Hingga 20%', 'label' => 'Diskon Produk', 'order' => 2],
            ],
            'float_tags' => [
                ['icon' => 'bi-truck-fill', 'text' => 'Free Ongkir', 'position' => 'hft1', 'order' => 0],
                ['icon' => 'bi-percent', 'text' => 'Diskon 20%', 'position' => 'hft2', 'order' => 1],
                ['icon' => 'bi-gift-fill', 'text' => 'Bundling Hemat', 'position' => 'hft3', 'order' => 2],
                ['icon' => 'bi-star-fill', 'text' => 'Poin Loyalitas', 'position' => 'hft4', 'order' => 3],
            ],
            'background_color_start' => '#1a2e1a',
            'background_color_end' => '#15412a',
            'is_active' => true,
        ]);

        // Create How to Claim Settings
        PromoHowtoSection::create([
            'is_active' => true,
            'tag' => 'Cara Klaim',
            'icon' => 'bi-question-circle-fill',
            'title' => 'Cara Mendapatkan Promo AROMAS',
            'description' => 'Proses klaim mudah dan cepat — langsung hubungi kami via WhatsApp atau order melalui channel resmi.',
            'steps' => [
                ['step_number' => 1, 'title' => 'Pilih Promo', 'description' => 'Temukan promo yang sesuai. Catat kode atau detail syaratnya.', 'order' => 0],
                ['step_number' => 2, 'title' => 'Hubungi via WhatsApp', 'description' => 'Klik tombol WhatsApp dan sebutkan promo yang ingin diklaim beserta pesanan.', 'order' => 1],
                ['step_number' => 3, 'title' => 'Konfirmasi & Bayar', 'description' => 'Tim kami konfirmasi pesanan dan kirimkan detail pembayaran dengan harga promo.', 'order' => 2],
                ['step_number' => 4, 'title' => 'Terima Pesanan', 'description' => 'Pesanan dikirim sesuai jadwal. Same-day delivery untuk area Tangsel jika order sebelum jam 12.', 'order' => 3],
            ],
        ]);

        // Create CTA Settings
        PromoCtaSection::create([
            'is_active' => true,
            'title' => 'Ada Promo yang Menarik Perhatian Anda?',
            'description' => 'Jangan tunda! Hubungi tim kami sekarang dan klaim keuntungan terbaik AROMAS untuk Anda.',
            'buttons' => [
                ['label' => 'Hubungi Sekarang', 'url' => 'https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20tahu%20promo%20yang%20tersedia', 'icon' => 'bi-whatsapp', 'style' => 'w', 'order' => 0],
                ['label' => 'Lihat Produk', 'url' => '/product', 'icon' => 'bi-box-seam-fill', 'style' => 'ol', 'order' => 1],
            ],
        ]);

        // Create or update promo campaigns
        $promos = [
            [
                'name' => 'Free Ongkir Area Ciater & Tangsel',
                'slug' => 'free-ongkir-ciater-tangsel',
                'promo_category_id' => $categoryIds['Free Ongkir'] ?? null,
                'tagline' => 'Gratis ongkos kirim ke seluruh wilayah South Tangerang. Min. 1 karton, same-day delivery tersedia.',
                'description' => 'Pesan AROMAS sekarang dan nikmati pengiriman gratis ke seluruh area Ciater, Serpong, dan South Tangerang. Min. pembelian 1 karton. Same-day delivery tersedia!',
                'is_active' => true,
                'is_featured' => true,
                'status_badge' => 'aktif',
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'sort_order' => 0,
                'whatsapp_message' => 'Halo AROMAS, saya mau klaim Free Ongkir Tangsel',
                'button_label' => 'Pesan Sekarang',
                'images' => [
                    ['url' => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=700&h=400&fit=crop', 'order' => 0, 'caption' => 'Delivery Truck'],
                    ['url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=700&h=400&fit=crop', 'order' => 1, 'caption' => 'Package Delivery'],
                ],
                'details' => [
                    ['label' => 'Berlaku Hingga', 'value' => '28 Februari 2026', 'order' => 0],
                    ['label' => 'Area Pengiriman', 'value' => 'South Tangerang & Ciater', 'order' => 1],
                    ['label' => 'Min. Pembelian', 'value' => '1 Karton (12 botol 1L)', 'order' => 2],
                    ['label' => 'Jam Pengiriman', 'value' => 'Senin – Sabtu, 08.00–17.00', 'order' => 3],
                ],
                'terms' => [
                    ['description' => 'Berlaku untuk area Ciater, Serpong, Serpong Utara, BSD, Pondok Aren, Ciputat, Pamulang.', 'order' => 0],
                    ['description' => 'Minimum pembelian 1 karton (12 botol 1L) atau setara nilainya.', 'order' => 1],
                    ['description' => 'Same-day delivery berlaku jika order diterima sebelum jam 12 siang.', 'order' => 2],
                    ['description' => 'Tidak berlaku bersamaan dengan promo free ongkir lainnya.', 'order' => 3],
                    ['description' => 'Promo dapat berakhir sewaktu-waktu jika kuota terpenuhi.', 'order' => 4],
                ],
            ],
            [
                'name' => 'Diskon 15% Pembelian Pertama',
                'slug' => 'diskon-15-pembelian-pertama',
                'promo_category_id' => $categoryIds['Diskon'] ?? null,
                'tagline' => 'Khusus pelanggan baru — hemat 15% untuk semua produk. Gunakan kode NEWMEMBER15.',
                'description' => 'Khusus pelanggan baru — hemat langsung 15% untuk semua produk AROMAS',
                'discount_percentage' => 15,
                'code' => 'NEWMEMBER15',
                'min_purchase' => 200000,
                'is_active' => true,
                'is_featured' => false,
                'status_badge' => 'terbatas',
                'start_date' => now(),
                'end_date' => now()->addDays(60),
                'sort_order' => 1,
                'whatsapp_message' => 'Halo AROMAS, saya mau klaim diskon 15% NEWMEMBER15',
                'button_label' => 'Klaim dengan Kode',
                'images' => [
                    ['url' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=700&h=400&fit=crop', 'order' => 0, 'caption' => 'New Member Discount'],
                ],
                'details' => [
                    ['label' => 'Besaran Diskon', 'value' => '15% untuk semua produk', 'order' => 0],
                    ['label' => 'Kode Promo', 'value' => 'NEWMEMBER15', 'order' => 1],
                    ['label' => 'Min. Pembelian', 'value' => 'Rp 200.000', 'order' => 2],
                    ['label' => 'Berlaku Hingga', 'value' => '31 Maret 2026', 'order' => 3],
                ],
                'terms' => [
                    ['description' => 'Hanya berlaku untuk pelanggan baru yang belum pernah melakukan pembelian AROMAS.', 'order' => 0],
                    ['description' => 'Berlaku untuk semua varian produk AROMAS (Botol, Jeriken, BIB).', 'order' => 1],
                    ['description' => 'Sebutkan kode NEWMEMBER15 saat menghubungi tim kami via WhatsApp.', 'order' => 2],
                    ['description' => 'Tidak dapat digabungkan dengan promo diskon lainnya.', 'order' => 3],
                    ['description' => 'Berlaku satu kali per pelanggan baru.', 'order' => 4],
                ],
            ],
            [
                'name' => 'Bundling Hemat: Beli 3 Gratis 1',
                'slug' => 'bundling-hemat-beli-3-gratis-1',
                'promo_category_id' => $categoryIds['Bundling'] ?? null,
                'tagline' => 'Beli 3 botol AROMAS 2L, gratis 1 botol 1L senilai Rp 35.000. Bisa kombinasi varian berbeda.',
                'description' => 'Beli 3 botol AROMAS 2L dalam satu transaksi, dapatkan 1 botol AROMAS 1L gratis — hemat Rp 35.000!',
                'is_active' => true,
                'is_featured' => false,
                'status_badge' => 'aktif',
                'start_date' => now(),
                'end_date' => now()->addDays(90),
                'sort_order' => 2,
                'whatsapp_message' => 'Halo AROMAS, saya mau klaim Bundling 3+1',
                'button_label' => 'Klaim Sekarang',
                'images' => [
                    ['url' => 'https://images.unsplash.com/photo-1563991655280-cb95c90ca2fb?w=700&h=400&fit=crop', 'order' => 0, 'caption' => 'Bundling Package'],
                    ['url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&h=400&fit=crop', 'order' => 1, 'caption' => 'Product Bundle'],
                ],
                'details' => [
                    ['label' => 'Produk Berlaku', 'value' => 'Botol AROMAS 2L (beli 3)', 'order' => 0],
                    ['label' => 'Produk Gratis', 'value' => 'Botol AROMAS 1L (1 pcs)', 'order' => 1],
                    ['label' => 'Nilai Hadiah', 'value' => 'Rp 35.000 / transaksi', 'order' => 2],
                    ['label' => 'Berlaku Hingga', 'value' => '30 April 2026', 'order' => 3],
                ],
                'terms' => [
                    ['description' => 'Beli 3 botol ukuran 2L dalam satu transaksi, dapatkan 1 botol 1L gratis.', 'order' => 0],
                    ['description' => 'Produk bundling bisa kombinasi berbagai varian botol 2L AROMAS.', 'order' => 1],
                    ['description' => 'Hadiah tidak dapat diganti dengan uang tunai.', 'order' => 2],
                    ['description' => 'Dapat digabungkan dengan promo free ongkir jika memenuhi syarat.', 'order' => 3],
                ],
            ],
            [
                'name' => 'Double Points — Program Loyalitas AROMAS',
                'slug' => 'double-points-loyalitas',
                'promo_category_id' => $categoryIds['Loyalitas'] ?? null,
                'tagline' => 'Tiap Rp 10.000 = 2 poin. Kumpulkan dan tukar dengan diskon atau produk gratis sepanjang 2026.',
                'description' => 'Kumpulkan poin 2x lebih cepat dan tukarkan dengan hadiah menarik sepanjang 2026!',
                'is_active' => true,
                'is_featured' => false,
                'status_badge' => 'aktif',
                'start_date' => now(),
                'end_date' => now()->addDays(300),
                'sort_order' => 3,
                'whatsapp_message' => 'Halo AROMAS, saya ingin bergabung Program Loyalitas',
                'button_label' => 'Daftar Member',
                'images' => [
                    ['url' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=700&h=400&fit=crop', 'order' => 0, 'caption' => 'Loyalty Program'],
                ],
                'details' => [
                    ['label' => 'Poin per Pembelian', 'value' => '2 poin per Rp 10.000', 'order' => 0],
                    ['label' => 'Penukaran Poin', 'value' => '1.000 poin = Rp 10.000', 'order' => 1],
                    ['label' => 'Berlaku Hingga', 'value' => '31 Desember 2026', 'order' => 2],
                    ['label' => 'Hadiah Tersedia', 'value' => 'Diskon, Produk, Voucher', 'order' => 3],
                ],
                'terms' => [
                    ['description' => 'Setiap pembelian Rp 10.000 menghasilkan 2 poin (periode normal hanya 1 poin).', 'order' => 0],
                    ['description' => 'Poin terakumulasi dan tidak kadaluarsa selama akun aktif melakukan pembelian.', 'order' => 1],
                    ['description' => 'Tukar poin via WhatsApp dengan menyebutkan jumlah poin yang ingin ditukar.', 'order' => 2],
                    ['description' => 'Daftar sebagai member melalui WhatsApp untuk mulai mengumpulkan poin.', 'order' => 3],
                ],
            ],
            [
                'name' => 'Harga Grosir Spesial — Diskon s/d 20%',
                'slug' => 'harga-grosir-diskon-20-persen',
                'promo_category_id' => $categoryIds['Grosir'] ?? null,
                'tagline' => 'Beli 5 karton diskon 10%, 10 karton 15%, 20+ karton diskon 20%. Semakin banyak semakin hemat.',
                'description' => 'Pembelian karton dalam jumlah besar dapatkan harga grosir terbaik dari AROMAS',
                'discount_percentage' => 20,
                'is_active' => true,
                'is_featured' => false,
                'status_badge' => 'aktif',
                'start_date' => now(),
                'end_date' => now()->addDays(60),
                'sort_order' => 4,
                'whatsapp_message' => 'Halo AROMAS, saya ingin harga grosir',
                'button_label' => 'Tanya Harga Grosir',
                'images' => [
                    ['url' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=700&h=400&fit=crop', 'order' => 0, 'caption' => 'Wholesale'],
                    ['url' => 'https://images.unsplash.com/photo-1604719312566-8912e9227f6a?w=700&h=400&fit=crop', 'order' => 1, 'caption' => 'Bulk Order'],
                ],
                'details' => [
                    ['label' => '5 Karton', 'value' => 'Diskon 10%', 'order' => 0],
                    ['label' => '10 Karton', 'value' => 'Diskon 15%', 'order' => 1],
                    ['label' => '20+ Karton', 'value' => 'Diskon 20%', 'order' => 2],
                    ['label' => 'Berlaku Hingga', 'value' => '31 Maret 2026', 'order' => 3],
                ],
                'terms' => [
                    ['description' => 'Minimum pembelian 5 karton untuk mendapatkan diskon grosir.', 'order' => 0],
                    ['description' => 'Berlaku untuk semua varian produk AROMAS yang tersedia.', 'order' => 1],
                    ['description' => 'Pengiriman gratis untuk pembelian 20 karton ke atas di area tertentu.', 'order' => 2],
                    ['description' => 'Hubungi tim sales untuk penawaran khusus di atas 50 karton.', 'order' => 3],
                ],
            ],
            [
                'name' => 'Flash Sale Jeriken 5L & 20L',
                'slug' => 'flash-sale-jeriken-5l-20l',
                'promo_category_id' => $categoryIds['Flash Sale'] ?? null,
                'tagline' => 'Diskon 10% khusus Jeriken AROMAS 5L dan 20L. Stok sangat terbatas, first come first served!',
                'description' => 'Diskon 10% khusus Jeriken AROMAS 5L dan 20L — stok sangat terbatas, segera pesan!',
                'discount_percentage' => 10,
                'is_active' => true,
                'is_featured' => false,
                'status_badge' => 'flash',
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'sort_order' => 5,
                'whatsapp_message' => 'Halo AROMAS, saya mau Flash Sale Jeriken 10%!',
                'button_label' => 'Pesan Sekarang!',
                'images' => [
                    ['url' => 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=700&h=400&fit=crop', 'order' => 0, 'caption' => 'Flash Sale'],
                ],
                'details' => [
                    ['label' => 'Produk', 'value' => 'Jeriken 5L & Jeriken 20L', 'order' => 0],
                    ['label' => 'Diskon', 'value' => '10% dari harga normal', 'order' => 1],
                    ['label' => 'Stok', 'value' => 'Sangat Terbatas', 'order' => 2],
                    ['label' => 'Berakhir', 'value' => '22 Februari 2026', 'order' => 3],
                ],
                'terms' => [
                    ['description' => 'Berlaku khusus untuk Jeriken AROMAS ukuran 5 liter dan 20 liter.', 'order' => 0],
                    ['description' => 'Diskon 10% langsung dari harga normal, berlaku per unit jeriken.', 'order' => 1],
                    ['description' => 'Stok terbatas — prinsip first come first served.', 'order' => 2],
                    ['description' => 'Flash sale berakhir otomatis saat stok habis atau tanggal berakhir.', 'order' => 3],
                ],
            ],
        ];

        foreach ($promos as $promoData) {
            PromoCampaign::updateOrCreate(
                ['slug' => $promoData['slug']],
                $promoData
            );
        }
    }
}
