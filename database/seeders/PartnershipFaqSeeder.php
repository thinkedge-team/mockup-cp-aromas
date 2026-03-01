<?php

namespace Database\Seeders;

use App\Models\PartnershipFaq;
use Illuminate\Database\Seeder;

class PartnershipFaqSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['question'=>'Apa perbedaan utama antara Distributor dan Agen/Reseller?','answer'=>'Distributor memiliki wilayah eksklusif, gudang sendiri, armada pengiriman, dan bertanggung jawab mendistribusikan ke retailer & agen di wilayahnya. Sementara Agen/Reseller beroperasi lebih fleksibel, bisa berjualan di berbagai platform termasuk online, dengan modal lebih kecil dan min. order lebih rendah. Agen/Reseller juga tidak memerlukan gudang besar.','sort_order'=>1],
            ['question'=>'Apakah ada biaya pendaftaran untuk menjadi mitra?','answer'=>'Untuk program Agen/Reseller, pendaftaran gratis. Program Franchise memerlukan biaya franchise fee yang sudah termasuk dalam paket investasi. Program Distributor memerlukan deposit modal kerja awal. Konsultasi awal selalu gratis untuk semua program.','sort_order'=>2],
            ['question'=>'Berapa lama proses pendaftaran hingga menjadi mitra aktif?','answer'=>'Agen/Reseller: 3–5 hari kerja. Distributor: 2–3 minggu (termasuk site visit dan review dokumen). Franchise: 4–8 minggu (termasuk survey lokasi, negosiasi, dan setup gerai). Maklon: 2–4 minggu untuk R&D dan approval sampel, kemudian 14–30 hari untuk produksi batch pertama.','sort_order'=>3],
            ['question'=>'Apakah bisa bergabung sebagai maklon tanpa badan usaha?','answer'=>'Untuk skema maklon, disarankan memiliki badan usaha (PT/CV) karena diperlukan untuk proses pengurusan sertifikasi Halal dan BPOM atas nama merek Anda. Namun kami bisa mendiskusikan alternatif solusi untuk perorangan yang serius membangun merek sendiri.','sort_order'=>4],
            ['question'=>'Apakah ada program upgrade dari Reseller ke Distributor?','answer'=>'Ya! AROMAS memiliki program upgrade tier yang jelas. Reseller berprestasi dapat mengajukan upgrade ke Agen, kemudian Distributor berdasarkan track record penjualan, kapasitas operasional, dan wilayah yang tersedia. Tim kami akan mendampingi proses upgrade ini.','sort_order'=>5],
            ['question'=>'Bagaimana sistem pembayaran dan kredit untuk mitra?','answer'=>'Mitra baru umumnya menggunakan sistem pembayaran di muka atau COD. Setelah 3–6 bulan kemitraan berjalan baik, dapat mengajukan fasilitas kredit dengan tenor 7–30 hari bergantung level kemitraan dan track record. Franchise dan Distributor dapat mengajukan kredit lebih awal dengan perjanjian tertulis.','sort_order'=>6],
        ];

        foreach ($items as $item) {
            PartnershipFaq::firstOrCreate(
                ['question' => $item['question']],
                array_merge($item, ['is_active' => true])
            );
        }
    }
}
