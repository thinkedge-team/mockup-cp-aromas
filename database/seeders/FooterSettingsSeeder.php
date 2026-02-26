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
                "id" => 1,
                "logo" => null,
                "company_description" =>
                    "AROMAS - Minyak goreng sawit premium berkualitas tinggi untuk keluarga Indonesia. Hadir dengan komitmen untuk menyediakan produk berkualitas dan sehat bagi masyarakat Indonesia.",
                "contact_info" => json_encode([
                    "phone" => "+62 21 1234 5678",
                    "email" => "info@aromas.co.id",
                    "address" =>
                        "Jl. Raya Ciater No. 123, Tangerang Selatan, Banten",
                    "whatsapp" => "+62 812 3456 7890",
                ]),
                "social_links" => json_encode([
                    "instagram" => "https://instagram.com/aromasindonesia",
                    "facebook" => "https://facebook.com/aromasindonesia",
                    "tiktok" => "https://tiktok.com/@aromasindonesia",
                    "youtube" => "https://youtube.com/@aromasindonesia",
                ]),
                "copyright_text" =>
                    "© 2024 AROMAS Indonesia. All rights reserved.",
                "legal_links" => json_encode([
                    "privacy" => "/privacy",
                    "terms" => "/terms",
                ]),
                "is_active" => true,
            ],
        ];

        // Use upsert to allow running seeder multiple times
        DB::table("footer_settings")->upsert(
            $settings,
            ["id"], // Unique constraint (only one footer)
            [
                "logo",
                "company_description",
                "contact_info",
                "social_links",
                "copyright_text",
                "legal_links",
                "is_active",
                "updated_at",
            ], // Columns to update
        );
    }
}
