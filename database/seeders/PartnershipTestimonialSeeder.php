<?php

namespace Database\Seeders;

use App\Models\PartnershipTestimonial;
use Illuminate\Database\Seeder;

class PartnershipTestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name'=>'Budi Santoso','role'=>'Gerai AROMAS Bekasi','avatar_url'=>'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face','text'=>'Bergabung sebagai franchisee AROMAS adalah keputusan terbaik. Dalam 14 bulan modal sudah kembali. Tim support-nya luar biasa responsif.','program_type'=>'franchise','sort_order'=>1],
            ['name'=>'Hendra Wijaya','role'=>'PT Sari Distribusi, Semarang','avatar_url'=>'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face','text'=>'Sebagai distributor eksklusif Kabupaten Semarang, omzet kami tumbuh 340% dalam 2 tahun. Sistem order online sangat memudahkan operasional.','program_type'=>'distributor','sort_order'=>2],
            ['name'=>'Dewi Rahayu','role'=>'Reseller Online, Surabaya','avatar_url'=>'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=100&h=100&fit=crop&crop=face','text'=>'Modal awal hanya Rp 8 juta, sekarang bisa raup Rp 15–20 juta per bulan dari jualan di Shopee dan Tokopedia. Materi promosi digital-nya sangat membantu!','program_type'=>'agen','sort_order'=>3],
            ['name'=>'Rizal Firmansyah','role'=>'Direktur PT Goldenia Food','avatar_url'=>'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=100&h=100&fit=crop&crop=face','text'=>'Layanan maklon AROMAS sangat profesional. Merek Goldenia kami kini sudah hadir di 8 provinsi. Kualitas produksi konsisten dan sertifikasi halal diproses cepat.','program_type'=>'maklon','sort_order'=>4],
            ['name'=>'Agus Pramono','role'=>'GM Procurement PT Nusa Sentosa','avatar_url'=>'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face','text'=>'Program Implan Korporasi AROMAS sangat menguntungkan perusahaan kami. Harga kompetitif, pengiriman tepat waktu, dan account manager kami selalu responsif setiap saat.','program_type'=>'implan','sort_order'=>5],
        ];

        foreach ($items as $item) {
            PartnershipTestimonial::firstOrCreate(
                ['name' => $item['name']],
                array_merge($item, ['is_active' => true])
            );
        }
    }
}
