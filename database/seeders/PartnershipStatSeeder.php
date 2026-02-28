<?php

namespace Database\Seeders;

use App\Models\PartnershipStat;
use Illuminate\Database\Seeder;

class PartnershipStatSeeder extends Seeder
{
    public function run(): void
    {
        PartnershipStat::firstOrCreate([], [
            'stats' => [
                ['value' => '500', 'suffix' => '+', 'label' => 'Mitra Aktif'],
                ['value' => '34',  'suffix' => '',  'label' => 'Provinsi Terjangkau'],
                ['value' => '15',  'suffix' => '+', 'label' => 'Tahun Pengalaman'],
                ['value' => '98',  'suffix' => '%', 'label' => 'Kepuasan Mitra'],
            ],
            'is_active' => true,
        ]);
    }
}
