<?php

namespace Database\Seeders;

use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Colors - Primary (Gold)
            ['setting_key' => 'primary_gold', 'setting_value' => 'd4a017', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Primary Gold', 'order' => 1, 'is_active' => true],
            ['setting_key' => 'primary_gold_dark', 'setting_value' => 'b8860b', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Primary Gold Dark', 'order' => 2, 'is_active' => true],
            ['setting_key' => 'primary_gold_light', 'setting_value' => 'f4c430', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Primary Gold Light', 'order' => 3, 'is_active' => true],
            ['setting_key' => 'amber', 'setting_value' => 'ffbf00', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Amber', 'order' => 4, 'is_active' => true],
            ['setting_key' => 'dark_gold', 'setting_value' => '8b6914', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Dark Gold', 'order' => 5, 'is_active' => true],

            // Colors - Secondary (Green)
            ['setting_key' => 'forest_green', 'setting_value' => '228b22', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Forest Green', 'order' => 10, 'is_active' => true],
            ['setting_key' => 'forest_green_dark', 'setting_value' => '0d3320', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Forest Green Dark', 'order' => 11, 'is_active' => true],
            ['setting_key' => 'forest_green_darker', 'setting_value' => '1a2e1a', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Forest Green Darker', 'order' => 12, 'is_active' => true],
            ['setting_key' => 'forest_green_light', 'setting_value' => '15412a', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Forest Green Light', 'order' => 13, 'is_active' => true],
            ['setting_key' => 'forest_green_pale', 'setting_value' => 'e8f5e9', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Forest Green Pale', 'order' => 14, 'is_active' => true],

            // Colors - Grays
            ['setting_key' => 'gray_100', 'setting_value' => 'f5f5f5', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 100', 'order' => 20, 'is_active' => true],
            ['setting_key' => 'gray_200', 'setting_value' => 'eeeeee', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 200', 'order' => 21, 'is_active' => true],
            ['setting_key' => 'gray_300', 'setting_value' => 'e0e0e0', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 300', 'order' => 22, 'is_active' => true],
            ['setting_key' => 'gray_400', 'setting_value' => 'bdbdbd', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 400', 'order' => 23, 'is_active' => true],
            ['setting_key' => 'gray_500', 'setting_value' => '9e9e9e', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 500', 'order' => 24, 'is_active' => true],
            ['setting_key' => 'gray_600', 'setting_value' => '757575', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 600', 'order' => 25, 'is_active' => true],
            ['setting_key' => 'gray_700', 'setting_value' => '616161', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 700', 'order' => 26, 'is_active' => true],
            ['setting_key' => 'gray_800', 'setting_value' => '424242', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 800', 'order' => 27, 'is_active' => true],
            ['setting_key' => 'gray_900', 'setting_value' => '212121', 'setting_type' => 'color', 'group' => 'colors', 'label' => 'Gray 900', 'order' => 28, 'is_active' => true],

            // Fonts
            ['setting_key' => 'font_primary', 'setting_value' => 'Poppins', 'setting_type' => 'font', 'group' => 'fonts', 'label' => 'Primary Font', 'order' => 1, 'is_active' => true],
            ['setting_key' => 'font_secondary', 'setting_value' => 'Playfair Display', 'setting_type' => 'font', 'group' => 'fonts', 'label' => 'Secondary Font', 'order' => 2, 'is_active' => true],
            ['setting_key' => 'font_blog_serif', 'setting_value' => 'Cormorant Garamond', 'setting_type' => 'font', 'group' => 'fonts', 'label' => 'Blog Serif Font', 'order' => 3, 'is_active' => true],
            ['setting_key' => 'font_blog_body', 'setting_value' => 'DM Sans', 'setting_type' => 'font', 'group' => 'fonts', 'label' => 'Blog Body Font', 'order' => 4, 'is_active' => true],
            ['setting_key' => 'font_blog_display', 'setting_value' => 'DM Serif Display', 'setting_type' => 'font', 'group' => 'fonts', 'label' => 'Blog Display Font', 'order' => 5, 'is_active' => true],

            // Spacing
            ['setting_key' => 'section_padding_y', 'setting_value' => '100px', 'setting_type' => 'number', 'group' => 'spacing', 'label' => 'Section Padding Vertical', 'order' => 1, 'is_active' => true],
            ['setting_key' => 'section_padding_sm', 'setting_value' => '60px', 'setting_type' => 'number', 'group' => 'spacing', 'label' => 'Section Padding Small', 'order' => 2, 'is_active' => true],

            // Border Radius
            ['setting_key' => 'radius_sm', 'setting_value' => '8px', 'setting_type' => 'number', 'group' => 'borders', 'label' => 'Border Radius Small', 'order' => 1, 'is_active' => true],
            ['setting_key' => 'radius_md', 'setting_value' => '12px', 'setting_type' => 'number', 'group' => 'borders', 'label' => 'Border Radius Medium', 'order' => 2, 'is_active' => true],
            ['setting_key' => 'radius_lg', 'setting_value' => '20px', 'setting_type' => 'number', 'group' => 'borders', 'label' => 'Border Radius Large', 'order' => 3, 'is_active' => true],
            ['setting_key' => 'radius_xl', 'setting_value' => '30px', 'setting_type' => 'number', 'group' => 'borders', 'label' => 'Border Radius XL', 'order' => 4, 'is_active' => true],
        ];

        // Use upsert to allow running seeder multiple times
        DB::table('theme_settings')->upsert(
            $settings,
            ['setting_key'], // Unique constraint
            ['setting_value', 'setting_type', 'group', 'label', 'order', 'is_active', 'updated_at'] // Columns to update
        );
    }
}
