<?php

namespace Database\Seeders;

use App\Models\ContactFaq;
use Illuminate\Database\Seeder;

class ContactFaqSeeder extends Seeder
{
    public function run(): void
    {
        ContactFaq::truncate();
        $faqs = [
            [
                'sort_order' => 1,
                'icon'       => 'truck',
                'question'   => 'Apakah AROMAS melayani pengiriman ke seluruh Indonesia?',
                'answer'     => 'Ya! AROMAS memiliki jaringan distribusi aktif di seluruh 34 provinsi Indonesia. Kami bermitra dengan lebih dari 500 distributor lokal dan menggunakan jasa pengiriman terpercaya untuk memastikan produk tiba dalam kondisi sempurna.',
            ],
            [
                'sort_order' => 2,
                'icon'       => 'bag-check',
                'question'   => 'Berapa minimum pemesanan untuk pembelian grosir?',
                'answer'     => 'Untuk pembelian grosir, minimum order dimulai dari 1 karton (isi sesuai varian produk). Untuk kontrak distribusi jangka panjang, kami memiliki ketentuan khusus. Hubungi tim sales kami untuk mendapatkan informasi harga dan MOQ terbaru.',
            ],
            [
                'sort_order' => 3,
                'icon'       => 'diagram-3',
                'question'   => 'Bagaimana cara mendaftar sebagai mitra distributor AROMAS?',
                'answer'     => 'Isi formulir di halaman ini dengan topik "Kemitraan / Distribusi", atau hubungi tim kami via WhatsApp. Tim business development akan menghubungi Anda dalam 1×24 jam untuk menjelaskan syarat, benefit, dan proses pendaftaran mitra AROMAS.',
            ],
            [
                'sort_order' => 4,
                'icon'       => 'award',
                'question'   => 'Apa saja sertifikasi produk AROMAS?',
                'answer'     => 'Produk AROMAS telah memperoleh: Halal MUI (sejak 2013), BPOM RI (izin edar pangan), SNI (Standar Nasional Indonesia), ISO 22000:2018 (manajemen keamanan pangan internasional), serta penghargaan Top Brand Award 2024 dan RSPO (sustainable palm oil).',
            ],
            [
                'sort_order' => 5,
                'icon'       => 'clock-history',
                'question'   => 'Berapa lama waktu pengiriman setelah order dikonfirmasi?',
                'answer'     => 'Untuk area Jabodetabek: 1–2 hari kerja. Jawa (luar Jabodetabek): 2–4 hari kerja. Luar Jawa: 4–7 hari kerja tergantung armada dan lokasi. Untuk order besar dengan kontrak, kami dapat mengatur jadwal pengiriman rutin sesuai kebutuhan Anda.',
            ],
            [
                'sort_order' => 6,
                'icon'       => 'credit-card',
                'question'   => 'Metode pembayaran apa saja yang tersedia?',
                'answer'     => 'Kami menerima: Transfer Bank (BCA, Mandiri, BRI, BNI), Virtual Account, QRIS, dan untuk mitra distributor terdaftar tersedia opsi pembayaran dengan termin (NET 14/30). Detail pembayaran akan diinformasikan oleh tim sales kami.',
            ],
        ];

        foreach ($faqs as $faq) {
            ContactFaq::create(array_merge($faq, ['is_active' => true]));
        }
    }
}
