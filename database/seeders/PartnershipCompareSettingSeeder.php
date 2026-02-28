<?php

namespace Database\Seeders;

use App\Models\PartnershipCompareSetting;
use Illuminate\Database\Seeder;

class PartnershipCompareSettingSeeder extends Seeder
{
    public function run(): void
    {
        PartnershipCompareSetting::firstOrCreate([], [
            'section_title'    => 'Bandingkan Program Kemitraan',
            'section_subtitle' => 'Pilih program yang paling sesuai dengan kapasitas, tujuan, dan skala bisnis Anda.',
            'rows'             => [
                ['feature'=>'Modal Awal','franchise_val'=>'Rp 50 – 150 Jt','distributor_val'=>'Rp 100 – 500 Jt','agen_val'=>'Rp 5 – 25 Jt','maklon_val'=>'Sesuai Volume','implan_val'=>'Kontrak MoU'],
                ['feature'=>'Merek Sendiri','franchise_val'=>'no','distributor_val'=>'no','agen_val'=>'no','maklon_val'=>'yes','implan_val'=>'partial'],
                ['feature'=>'Wilayah Eksklusif','franchise_val'=>'yes','distributor_val'=>'yes','agen_val'=>'partial','maklon_val'=>'partial','implan_val'=>'no'],
                ['feature'=>'Dukungan Pemasaran','franchise_val'=>'yes','distributor_val'=>'yes','agen_val'=>'yes','maklon_val'=>'partial','implan_val'=>'partial'],
                ['feature'=>'Pelatihan Tim','franchise_val'=>'yes','distributor_val'=>'yes','agen_val'=>'yes','maklon_val'=>'partial','implan_val'=>'yes'],
                ['feature'=>'Margin Keuntungan','franchise_val'=>'Tinggi','distributor_val'=>'Sangat Tinggi','agen_val'=>'Menengah','maklon_val'=>'Custom','implan_val'=>'Harga Korporasi'],
                ['feature'=>'Custom Kemasan','franchise_val'=>'no','distributor_val'=>'no','agen_val'=>'no','maklon_val'=>'yes','implan_val'=>'yes'],
                ['feature'=>'Min. Order Bulanan','franchise_val'=>'500 L','distributor_val'=>'5.000 L','agen_val'=>'100 L','maklon_val'=>'10.000 L/batch','implan_val'=>'50.000 L'],
                ['feature'=>'Program Bonus','franchise_val'=>'yes','distributor_val'=>'yes','agen_val'=>'yes','maklon_val'=>'partial','implan_val'=>'no'],
                ['feature'=>'Cocok Untuk','franchise_val'=>'Pengusaha berpengalaman','distributor_val'=>'Perusahaan distribusi','agen_val'=>'Pemula & UMKM','maklon_val'=>'Pemilik merek','implan_val'=>'Korporasi / Instansi'],
            ],
            'is_active' => true,
        ]);
    }
}
