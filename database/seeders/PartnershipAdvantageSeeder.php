<?php

namespace Database\Seeders;

use App\Models\PartnershipAdvantage;
use Illuminate\Database\Seeder;

class PartnershipAdvantageSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['icon'=>'award-fill','title'=>'Produk Bersertifikat','description'=>'Halal MUI, BPOM, SNI, dan ISO 22000 — standar kualitas internasional yang tidak perlu diragukan.','sort_order'=>1],
            ['icon'=>'headset','title'=>'Support 24/7','description'=>'Tim dedicated untuk setiap mitra, siap membantu operasional, pemasaran, dan pengembangan bisnis.','sort_order'=>2],
            ['icon'=>'graph-up-arrow','title'=>'Pertumbuhan Terbukti','description'=>'98% mitra AROMAS mencatatkan pertumbuhan omzet positif dalam 12 bulan pertama kemitraan.','sort_order'=>3],
            ['icon'=>'truck-front-fill','title'=>'Distribusi Nasional','description'=>'Jaringan logistik ke 34 provinsi dengan armada pengiriman tepat waktu dan sistem tracking real-time.','sort_order'=>4],
            ['icon'=>'currency-exchange','title'=>'Harga Kompetitif','description'=>'Struktur harga khusus mitra yang memastikan margin keuntungan optimal di setiap level kemitraan.','sort_order'=>5],
            ['icon'=>'megaphone-fill','title'=>'Dukungan Marketing','description'=>'Materi iklan, konten digital, dan kampanye promosi nasional yang mendukung penjualan mitra.','sort_order'=>6],
            ['icon'=>'mortarboard-fill','title'=>'Pelatihan Berkelanjutan','description'=>'Program training reguler: product knowledge, teknik penjualan, dan manajemen bisnis untuk tim Anda.','sort_order'=>7],
            ['icon'=>'shield-fill-check','title'=>'Kontrak Transparan','description'=>'Perjanjian kemitraan yang adil, transparan, dan melindungi kepentingan kedua belah pihak.','sort_order'=>8],
        ];

        foreach ($items as $item) {
            PartnershipAdvantage::firstOrCreate(
                ['title' => $item['title']],
                array_merge($item, ['is_active' => true])
            );
        }
    }
}
