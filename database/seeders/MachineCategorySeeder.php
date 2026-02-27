<?php

namespace Database\Seeders;

use App\Models\MachineCategory;
use Illuminate\Database\Seeder;

class MachineCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MachineCategory::create([
            'name' => 'Blowing',
            'slug' => 'blowing',
            'icon' => 'bi-wind',
            'color' => '#e65100',
            'order' => 1,
            'is_active' => true,
        ]);

        MachineCategory::create([
            'name' => 'Filling & Capping',
            'slug' => 'filling',
            'icon' => 'bi-droplet-half',
            'color' => '#228b22',
            'order' => 2,
            'is_active' => true,
        ]);

        MachineCategory::create([
            'name' => 'Labeling',
            'slug' => 'labeling',
            'icon' => 'bi-tag-fill',
            'color' => '#0077b6',
            'order' => 3,
            'is_active' => true,
        ]);

        MachineCategory::create([
            'name' => 'Packaging',
            'slug' => 'packaging',
            'icon' => 'bi-box-seam-fill',
            'color' => '#7b2d8b',
            'order' => 4,
            'is_active' => true,
        ]);

        MachineCategory::create([
            'name' => 'Conveyor',
            'slug' => 'conveyor',
            'icon' => 'bi-arrows-move',
            'color' => '#795548',
            'order' => 5,
            'is_active' => true,
        ]);

        MachineCategory::create([
            'name' => 'Refinery',
            'slug' => 'refinery',
            'icon' => 'bi-fire',
            'color' => '#d4a017',
            'order' => 6,
            'is_active' => true,
        ]);
    }
}
