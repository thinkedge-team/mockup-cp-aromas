<?php

namespace Database\Seeders;

use App\Models\AboutCertification;
use Illuminate\Database\Seeder;

class AboutCertificationSeeder extends Seeder
{
    public function run(): void
    {
        $certs = [
            ['icon' => 'moon-stars-fill', 'name' => 'Halal MUI', 'issuer' => 'Majelis Ulama Indonesia', 'year' => 2013, 'sort_order' => 1],
            ['icon' => 'shield-check', 'name' => 'BPOM RI', 'issuer' => 'Izin Edar Pangan', 'year' => 2013, 'sort_order' => 2],
            ['icon' => 'globe', 'name' => 'ISO 22000', 'issuer' => 'Food Safety Mgmt', 'year' => 2019, 'sort_order' => 3],
            ['icon' => 'trophy-fill', 'name' => 'Top Brand', 'issuer' => 'Frontier Consulting', 'year' => 2024, 'sort_order' => 4],
            ['icon' => 'star-fill', 'name' => 'Best Brand', 'issuer' => 'SWA Magazine & MARS', 'year' => 2023, 'sort_order' => 5],
            ['icon' => 'tree-fill', 'name' => 'RSPO', 'issuer' => 'Sustainable Palm Oil', 'year' => 2020, 'sort_order' => 6],
        ];

        foreach ($certs as $cert) {
            AboutCertification::create(array_merge($cert, ['is_active' => true]));
        }
    }
}
