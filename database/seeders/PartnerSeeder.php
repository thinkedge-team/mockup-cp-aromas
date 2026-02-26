<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::create([
            'name' => 'Indomaret',
            'icon' => 'bi-shop',
            'order' => 1,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Alfamart',
            'icon' => 'bi-shop',
            'order' => 2,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Hypermart',
            'icon' => 'bi-cart4',
            'order' => 3,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Giant',
            'icon' => 'bi-bag',
            'order' => 4,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Superindo',
            'icon' => 'bi-basket',
            'order' => 5,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Tokopedia',
            'icon' => 'bi-globe',
            'order' => 6,
            'is_active' => true,
        ]);
    }
}
