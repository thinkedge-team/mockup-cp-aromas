<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin User (using updateOrCreate for re-runability)
        User::updateOrCreate(
            ["email" => "admin@aromas.local"],
            [
                "name" => "Admin",
                "password" => bcrypt("password"),
                "email_verified_at" => now(),
            ],
        );

        // Call seeders
        $this->call([
            FooterSettingsSeeder::class,
            HeroSlideSeeder::class,
            ImpactStatSeeder::class,
            AwardSeeder::class,
            ServiceSeeder::class,
            BenefitSeeder::class,
            PartnerSeeder::class,
            VideoSettingSeeder::class,
            FaqItemSeeder::class,
            BranchSeeder::class,
            MissionSectionSeeder::class,
            ProductHeroSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductAdvantageSeeder::class,
            ProductCtaSeeder::class,
        ]);
    }
}
