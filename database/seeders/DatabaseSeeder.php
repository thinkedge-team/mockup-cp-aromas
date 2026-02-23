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
            ['email' => 'admin@aromas.local'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Call all other seeders
        $this->call([
            SiteSettingsSeeder::class,
            NavigationSettingsSeeder::class,
            FooterSettingsSeeder::class,
            ThemeSettingsSeeder::class,
        ]);
    }
}
