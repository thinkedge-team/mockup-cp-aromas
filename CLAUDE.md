# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Full dev environment (PHP server + queue + pail log + Vite HMR)
composer dev

# Initial project setup
composer setup

# Run tests
composer test

# Run a single test file
php artisan test --filter TestClassName

# Build frontend assets
npm run build

# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create a new Filament resource
php artisan make:filament-resource ModelName

# Create a new migration
php artisan make:migration create_table_name
```

## Admin Panel

- URL: `http://localhost:8000/admin`
- Default credentials: `admin@aromas.local` / `password`
- Filament auto-discovers all resources in `app/Filament/Resources/`

## Architecture

**AROMAS** is a company CMS for an Indonesian premium cooking oil brand. The public-facing site is a multi-page marketing site; all content is managed via a Filament 3 admin panel.

### Stack
- **Laravel 12** — routing, models, controllers
- **Filament 3** — admin CMS at `/admin`
- **SQLite** — database (`database/database.sqlite`)
- **Spatie Media Library 11** — file/image uploads
- **Livewire** — admin navigation search component
- **Bootstrap 5** (CDN) + AOS + Leaflet — public frontend
- **Tailwind CSS 4 + Vite** — compiled assets (used internally; public pages reference `public/css/style.css` and `public/js/script.js` directly)

### Public Pages & Controllers
Each route in `routes/web.php` maps to a Blade view under `resources/views/`. Most pages render data directly from models; complex pages use controllers:
- `BlogController` — blog listing, detail, search, category/tag filters, comments, likes
- `PortfolioController` — portfolio listing
- `PromoPageController` — promo page
- `ContactFormController` — contact form submission with email + rate limiting

Blade layout: `resources/views/layouts/app.blade.php`. Shared partials (header, footer, preloader) live in `resources/views/partials/`.

### Admin CMS Architecture
Navigation groups in the admin panel (defined in `app/Providers/Filament/AdminPanelProvider.php`) map to page sections: Beranda, Tentang Kami, Produk, Mesin, Promo, Blog, Portofolio, Kontak, Partnership, Settings.

**Two model patterns:**
1. **Singleton settings** — one row per table representing page-section configuration (e.g., `AboutHeroSetting`, `BlogSetting`). These use a static `getInstance()` method: `BlogSetting::getInstance()`.
2. **List items** — normal multi-row models (e.g., `BlogPost`, `Product`, `Machine`, `Distributor`).

Every Filament resource follows the standard `app/Filament/Resources/{Model}Resource.php` + `Pages/` subdirectory structure.

### Livewire Admin Navigation Search
`app/Livewire/NavigationSearch.php` powers a custom search widget injected into the Filament admin header via a render hook. The `NavigationIndexer` service (`app/Services/NavigationIndexer.php`) indexes all registered Filament resources for fuzzy search.

### Media
Images are managed via Spatie Media Library. Run `php artisan storage:link` if the `public/storage` symlink is missing.

### Reference Files
`temp-static/` contains the original static HTML mockups used as design reference when building the CMS. Do not delete these.
