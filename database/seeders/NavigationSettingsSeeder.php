<?php

namespace Database\Seeders;

use App\Models\NavigationSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'id' => 1,
                'location' => 'header',
                'menu_items' => json_encode([
                    [
                        'label' => 'Beranda',
                        'url' => '/',
                        'icon' => 'heroicon-o-home',
                        'order' => 1,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Tentang Kami',
                        'url' => '/about',
                        'icon' => null,
                        'order' => 2,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Produk',
                        'url' => '/product',
                        'icon' => null,
                        'order' => 3,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Mesin',
                        'url' => '/our-machine',
                        'icon' => null,
                        'order' => 4,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Promo',
                        'url' => '/promo',
                        'icon' => null,
                        'order' => 5,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Blog',
                        'url' => '/blog',
                        'icon' => null,
                        'order' => 6,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Portofolio',
                        'url' => '/portfolio',
                        'icon' => null,
                        'order' => 7,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Kontak',
                        'url' => '/contact-us',
                        'icon' => null,
                        'order' => 8,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                ]),
                'logo' => 'logo.png',
                'logo_height' => 44,
                'cta_button_text' => 'Partnership',
                'cta_button_url' => '/partnership',
                'is_sticky' => true,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'location' => 'footer',
                'menu_items' => json_encode([
                    [
                        'label' => 'Tentang Kami',
                        'url' => '/about',
                        'icon' => null,
                        'order' => 1,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Produk',
                        'url' => '/product',
                        'icon' => null,
                        'order' => 2,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Kemitraan',
                        'url' => '/partnership',
                        'icon' => null,
                        'order' => 3,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                    [
                        'label' => 'Kontak',
                        'url' => '/contact-us',
                        'icon' => null,
                        'order' => 4,
                        'open_in_new_tab' => false,
                        'dropdown_items' => [],
                    ],
                ]),
                'logo' => null,
                'logo_height' => 40,
                'cta_button_text' => null,
                'cta_button_url' => null,
                'is_sticky' => false,
                'is_active' => true,
            ],
        ];

        // Use upsert to allow running seeder multiple times
        DB::table('navigation_settings')->upsert(
            $settings,
            ['location'], // Unique constraint
            ['menu_items', 'logo', 'logo_height', 'cta_button_text', 'cta_button_url', 'is_sticky', 'is_active', 'updated_at'] // Columns to update
        );
    }
}
