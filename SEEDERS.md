# Seeders Documentation

## Overview
All seeders are now **idempotent** - they can be run multiple times safely without creating duplicates or errors.

## Usage

### Run All Seeders
```bash
php artisan db:seed
```

### Run Specific Seeder
```bash
php artisan db:seed --class=SiteSettingsSeeder
php artisan db:seed --class=NavigationSettingsSeeder
php artisan db:seed --class=FooterSettingsSeeder
php artisan db:seed --class=ThemeSettingsSeeder
```

### Fresh Database + Seed
```bash
php artisan migrate:fresh --seed
```

---

## Seeders Structure

### DatabaseSeeder (Main Seeder)
**File**: `database/seeders/DatabaseSeeder.php`

Calls all other seeders in order:
1. User (Admin account)
2. SiteSettingsSeeder
3. NavigationSettingsSeeder
4. FooterSettingsSeeder
5. ThemeSettingsSeeder

**Admin Credentials**:
- Email: `admin@aromas.local`
- Password: `password`

---

### SiteSettingsSeeder
**File**: `database/seeders/SiteSettingsSeeder.php`

**Purpose**: Global site configuration

**Settings Seeded** (25 total):
- **General** (3): site_name, site_tagline, site_description
- **Contact** (7): phone, whatsapp, email, address, city, province, postal_code
- **Social Media** (6): facebook, instagram, twitter, youtube, tiktok, linkedin URLs
- **Branding** (4): years_experience, customers_count, partners_count, certifications
- **SEO** (5): default_title, default_description, default_keywords, google_analytics, facebook_pixel

**Unique Key**: `key` field
**Method**: `DB::upsert()` on `key` column

---

### NavigationSettingsSeeder
**File**: `database/seeders/NavigationSettingsSeeder.php`

**Purpose**: Header and footer navigation configuration

**Settings Seeded** (2 total):
1. **Header Navigation**:
   - 8 menu items (Beranda, Tentang Kami, Produk, Mesin, Promo, Blog, Portofolio, Kontak)
   - CTA Button: "Partnership" → `/partnership`
   - Sticky header: enabled

2. **Footer Navigation**:
   - 4 menu items (Tentang Kami, Produk, Kemitraan, Kontak)
   - No CTA button
   - Sticky: disabled

**Unique Key**: `location` field (header, footer)
**Method**: `DB::upsert()` on `location` column

---

### FooterSettingsSeeder
**File**: `database/seeders/FooterSettingsSeeder.php`

**Purpose**: Footer content configuration

**Settings Seeded** (1 total):
- Company description
- Contact info (phone, email, address, whatsapp)
- Link columns (Navigasi, Dukungan, Legal)
- Social media links (5 platforms)
- Copyright text
- Legal links (Privacy Policy, Terms of Service)

**Unique Key**: `id` field (only one footer allowed)
**Method**: `DB::upsert()` on `id` column

---

### ThemeSettingsSeeder
**File**: `database/seeders/ThemeSettingsSeeder.php`

**Purpose**: Visual theme customization

**Settings Seeded** (38 total):
- **Colors** (19):
  - Primary Gold palette (5): primary_gold, primary_gold_dark, primary_gold_light, amber, dark_gold
  - Forest Green palette (5): forest_green, forest_green_dark, forest_green_darker, forest_green_light, forest_green_pale
  - Gray scale (10): gray_100 through gray_900
- **Fonts** (5): font_primary, font_secondary, font_blog_serif, font_blog_body, font_blog_display
- **Spacing** (2): section_padding_y, section_padding_sm
- **Borders** (4): radius_sm, radius_md, radius_lg, radius_xl

**Unique Key**: `setting_key` field
**Method**: `DB::upsert()` on `setting_key` column

---

## Technical Details

### Upsert Implementation
All seeders use Laravel's `DB::upsert()` method:

```php
DB::table('table_name')->upsert(
    $records, // Array of data
    ['unique_column'], // Unique constraint columns
    ['columns', 'to', 'update'] // Columns to update on conflict
);
```

### Benefits
✅ **Safe to run multiple times** - No duplicates  
✅ **Updates existing data** - Changes in seeder will update database  
✅ **Fast** - Single query per seeder  
✅ **Consistent** - Always produces same result  

### JSON Encoding
All array/object values are JSON-encoded before storing:
```php
'value' => json_encode(['array', 'data'])
```

This ensures compatibility with SQLite and consistent storage format.

---

## Modifying Seed Data

To change seeded data:
1. Edit the respective seeder file
2. Run `php artisan db:seed --class=SeederName`
3. Data will be updated automatically

**Example**: Change site name
```php
// Edit SiteSettingsSeeder.php
[
    'key' => 'site_name',
    'value' => json_encode('NEW SITE NAME'), // Change this
    // ...
]
```

Then run:
```bash
php artisan db:seed --class=SiteSettingsSeeder
```

---

## Troubleshooting

### Error: UNIQUE constraint failed
This shouldn't happen with upsert. If it does:
1. Check if the unique column exists in your data
2. Ensure JSON values are properly encoded with `json_encode()`

### Data not updating
Check that the unique column matches an existing record. The seeder will UPDATE existing records and INSERT new ones.

### Reset Everything
```bash
php artisan migrate:fresh --seed
```
⚠️ **Warning**: This deletes ALL data and reseeds!
