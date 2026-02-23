<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => json_encode('AROMAS'),
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'site_tagline',
                'value' => json_encode('Minyak Goreng Premium Berkualitas Tinggi Indonesia'),
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Tagline',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'site_description',
                'value' => json_encode('AROMAS - Minyak goreng sawit premium berkualitas tinggi untuk keluarga Indonesia. Rendah kolesterol, jernih, tahan panas tinggi dengan sertifikasi BPOM & Halal MUI.'),
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'order' => 3,
                'is_active' => true,
            ],

            // Contact Settings
            [
                'key' => 'contact_phone',
                'value' => json_encode('+62 21 1234 5678'),
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Phone Number',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => json_encode('+62 812 3456 7890'),
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp Number',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'contact_email',
                'value' => json_encode('info@aromas.co.id'),
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Email Address',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'contact_address',
                'value' => json_encode('Jl. Raya Ciater No. 123, Tangerang Selatan, Banten, Indonesia'),
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Office Address',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'contact_city',
                'value' => json_encode('Tangerang Selatan'),
                'type' => 'text',
                'group' => 'contact',
                'label' => 'City',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'contact_province',
                'value' => json_encode('Banten'),
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Province',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'key' => 'contact_postal_code',
                'value' => json_encode('15310'),
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Postal Code',
                'order' => 7,
                'is_active' => true,
            ],

            // Social Media Settings
            [
                'key' => 'social_facebook',
                'value' => json_encode('https://facebook.com/aromasindonesia'),
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'social_instagram',
                'value' => json_encode('https://instagram.com/aromasindonesia'),
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'social_twitter',
                'value' => json_encode('https://twitter.com/aromasindonesia'),
                'type' => 'text',
                'group' => 'social',
                'label' => 'Twitter URL',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'social_youtube',
                'value' => json_encode('https://youtube.com/@aromasindonesia'),
                'type' => 'text',
                'group' => 'social',
                'label' => 'YouTube URL',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'social_tiktok',
                'value' => json_encode('https://tiktok.com/@aromasindonesia'),
                'type' => 'text',
                'group' => 'social',
                'label' => 'TikTok URL',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'social_linkedin',
                'value' => json_encode('https://linkedin.com/company/aromasindonesia'),
                'type' => 'text',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'order' => 6,
                'is_active' => true,
            ],

            // Branding Settings
            [
                'key' => 'brand_years_experience',
                'value' => json_encode('15'),
                'type' => 'number',
                'group' => 'branding',
                'label' => 'Years of Experience',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'brand_customers_count',
                'value' => json_encode('1000000'),
                'type' => 'number',
                'group' => 'branding',
                'label' => 'Number of Customers',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'brand_partners_count',
                'value' => json_encode('500'),
                'type' => 'number',
                'group' => 'branding',
                'label' => 'Number of Partners',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'brand_certifications',
                'value' => json_encode(['BPOM', 'Halal MUI', 'ISO 22000:2018', 'Top Brand 2024']),
                'type' => 'array',
                'group' => 'branding',
                'label' => 'Certifications',
                'order' => 4,
                'is_active' => true,
            ],

            // SEO Settings
            [
                'key' => 'seo_default_title',
                'value' => json_encode('AROMAS - Minyak Goreng Premium Berkualitas Tinggi Indonesia'),
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Default Page Title',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'seo_default_description',
                'value' => json_encode('AROMAS - Minyak goreng sawit premium berkualitas tinggi untuk keluarga Indonesia. Rendah kolesterol, jernih, tahan panas tinggi dengan sertifikasi BPOM & Halal MUI.'),
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Default Meta Description',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'seo_default_keywords',
                'value' => json_encode('minyak goreng, minyak goreng premium, minyak sawit, AROMAS, cooking oil, palm oil, minyak goreng sehat, minyak goreng Indonesia'),
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Default Keywords',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'seo_google_analytics',
                'value' => json_encode(''),
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Google Analytics Code',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'seo_facebook_pixel',
                'value' => json_encode(''),
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Facebook Pixel Code',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        // Use upsert to allow running seeder multiple times
        DB::table('site_settings')->upsert(
            $settings,
            ['key'], // Unique constraint
            ['value', 'type', 'group', 'label', 'order', 'is_active', 'updated_at'] // Columns to update
        );
    }
}
