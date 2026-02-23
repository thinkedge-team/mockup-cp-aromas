# AROMAS CMS - Content Management System

## Project Structure
```
mockup-cp-aromas/
├── [CMS Root]              ← Laravel app (this is where CMS lives)
│   ├── app/
│   ├── database/
│   ├── public/
│   └── ...
├── temp-static/            ← Original static HTML files (backup/reference)
│   ├── index.html
│   ├── about.html
│   ├── product.html
│   └── ...
```

## Quick Start

### Access Admin Panel
1. Start server: `php artisan serve`
2. Visit: `http://localhost:8000/admin`
3. Login:
   - **Email**: `admin@aromas.local`
   - **Password**: `password`

## Tech Stack
- **Laravel**: 12.x
- **Filament**: 3.x (Admin Panel)
- **Database**: SQLite
- **Media Library**: Spatie 11.x

## What's Installed
✅ Laravel 12 project  
✅ Filament 3 admin panel at `/admin`  
✅ SQLite database configured  
✅ Spatie Media Library for file uploads  
✅ Admin user seeded via DatabaseSeeder  
✅ Storage symlink for media access  
✅ AROMAS branding (gold #d4a017, green #228b22)  

## Original Static Files
All original static HTML files are backed up in `temp-static/` folder for reference when building the CMS content structure.

## Next Steps (Phase 2)
Build content models and Filament resources for:
1. Site Settings
2. Pages & Page Sections
3. Products
4. Blog Posts
5. Portfolio Items
6. Partnership Programs
7. Contact Inquiries
8. Media Library management

## Common Commands
```bash
# Start development server
php artisan serve

# Clear caches
php artisan optimize:clear

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create new Filament resource
php artisan make:filament-resource ModelName

# Create new migration
php artisan make:migration create_table_name
```
