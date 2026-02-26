<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::create([
            'name' => 'Cabang Jakarta Pusat',
            'category' => 'Outlet Premium',
            'address' => 'Jl. Industri Raya No. 123, Jakarta 12345',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'phone' => '(021) 1234-5678',
            'whatsapp' => '6281234567890',
            'map_link' => 'https://maps.google.com/?q=Jl.+Industri+Raya+No.+123+Jakarta',
            'operating_hours' => [
                'open' => '08:00',
                'close' => '17:00',
                'days' => 'Senin - Jumat',
            ],
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'Cabang Surabaya Timur',
            'category' => 'Outlet Standar',
            'address' => 'Jl. Raya Surabaya No. 45, Jawa Timur 60111',
            'latitude' => -7.2575,
            'longitude' => 112.7521,
            'phone' => '(031) 9876-5432',
            'whatsapp' => '6281345678901',
            'map_link' => 'https://maps.google.com/?q=Jl.+Raya+Surabaya+No.+45',
            'operating_hours' => [
                'open' => '08:00',
                'close' => '17:00',
                'days' => 'Senin - Jumat',
            ],
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'Cabang Bandung Utara',
            'category' => 'Outlet Premium',
            'address' => 'Jl. Braga No. 67, Bandung 40111, Jawa Barat',
            'latitude' => -6.9175,
            'longitude' => 107.6191,
            'phone' => '(022) 2345-6789',
            'whatsapp' => '6281456789012',
            'map_link' => 'https://maps.google.com/?q=Jl.+Braga+No.+67+Bandung',
            'operating_hours' => [
                'open' => '08:00',
                'close' => '17:00',
                'days' => 'Senin - Jumat',
            ],
            'is_active' => true,
        ]);
    }
}
