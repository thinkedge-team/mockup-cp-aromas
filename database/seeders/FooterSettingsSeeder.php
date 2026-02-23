<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'id' => 1,
                'logo' => null,
                'company_description' => 'AROMAS - Minyak goreng sawit premium berkualitas tinggi untuk keluarga Indonesia. Hadir dengan komitmen untuk menyediakan produk berkualitas dan sehat bagi masyarakat Indonesia.',
                'contact_info' => json_encode([
                    'phone' => '+62 21 1234 5678',
                    'email' => 'info@aromas.co.id',
                    'address' => 'Jl. Raya Ciater No. 123, Tangerang Selatan, Banten',
                    'whatsapp' => '+62 812 3456 7890',
                ]),
                'link_columns' => json_encode([
                    [
                        'title' => 'Navigasi',
                        'links' => [
                            ['label' => 'Beranda', 'url' => '/', 'open_in_new_tab' => false],
                            ['label' => 'Tentang Kami', 'url' => '/about', 'open_in_new_tab' => false],
                            ['label' => 'Produk', 'url' => '/product', 'open_in_new_tab' => false],
                            ['label' => 'Kemitraan', 'url' => '/partnership', 'open_in_new_tab' => false],
                        ],
                    ],
                    [
                        'title' => 'Dukungan',
                        'links' => [
                            ['label' => 'Kontak', 'url' => '/contact-us', 'open_in_new_tab' => false],
                            ['label' => 'FAQ', 'url' => '/faq', 'open_in_new_tab' => false],
                            ['label' => 'Karir', 'url' => '/career', 'open_in_new_tab' => false],
                        ],
                    ],
                    [
                        'title' => 'Legal',
                        'links' => [
                            ['label' => 'Privacy Policy', 'url' => '/privacy', 'open_in_new_tab' => false],
                            ['label' => 'Terms of Service', 'url' => '/terms', 'open_in_new_tab' => false],
                        ],
                    ],
                ]),
                'social_links' => json_encode([
                    ['platform' => 'facebook', 'url' => 'https://facebook.com/aromasindonesia', 'icon' => 'fab fa-facebook'],
                    ['platform' => 'instagram', 'url' => 'https://instagram.com/aromasindonesia', 'icon' => 'fab fa-instagram'],
                    ['platform' => 'twitter', 'url' => 'https://twitter.com/aromasindonesia', 'icon' => 'fab fa-twitter'],
                    ['platform' => 'youtube', 'url' => 'https://youtube.com/@aromasindonesia', 'icon' => 'fab fa-youtube'],
                    ['platform' => 'linkedin', 'url' => 'https://linkedin.com/company/aromasindonesia', 'icon' => 'fab fa-linkedin'],
                ]),
                'copyright_text' => '© 2024 AROMAS Indonesia. All rights reserved.',
                'legal_links' => json_encode([
                    ['label' => 'Privacy Policy', 'url' => '/privacy'],
                    ['label' => 'Terms of Service', 'url' => '/terms'],
                ]),
                'is_active' => true,
            ],
        ];

        // Use upsert to allow running seeder multiple times
        DB::table('footer_settings')->upsert(
            $settings,
            ['id'], // Unique constraint (only one footer)
            ['logo', 'company_description', 'contact_info', 'link_columns', 'social_links', 'copyright_text', 'legal_links', 'is_active', 'updated_at'] // Columns to update
        );
    }
}
