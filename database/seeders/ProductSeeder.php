<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // BOTOL CATEGORY PRODUCTS
        Product::create([
            "category_id" => 1, // Botol
            "name" => "AROMAS Botol Mini",
            "tagline" => "Praktis untuk pemakaian harian & perjalanan",
            "badge_text" => "Rumah Tangga",
            "images" => [
                [
                    "url" =>
                        "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop",
                    "order" => 0,
                    "is_banner" => true,
                ],
            ],
            "sizes" => [
                ["volume" => 200, "unit" => "ml", "is_popular" => false],
                ["volume" => 220, "unit" => "ml", "is_popular" => false],
                ["volume" => 400, "unit" => "ml", "is_popular" => true],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Kemasan HDPE food-grade",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Tutup anti-tumpah presisi",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk 1-2 orang",
                ],
            ],
            "modal_title" => "AROMAS Botol Mini",
            "modal_subtitle" => "Solusi praktis untuk kebutuhan memasak harian",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Botol HDPE"],
                ["label" => "Volume", "value" => "200ml - 400ml"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Food-grade HDPE"],
                ["icon" => "bi-shield-check", "text" => "Tutup rapat"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk Botol Mini",
            "order" => 1,
            "is_active" => true,
        ]);

        Product::create([
            "category_id" => 1, // Botol
            "name" => "AROMAS Botol Standar",
            "tagline" => "Ukuran pas untuk keluarga kecil",
            "badge_text" => "Best Seller",
            "images" => [
                [
                    "url" =>
                        "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop",
                    "order" => 0,
                    "is_banner" => true,
                ],
            ],
            "sizes" => [
                ["volume" => 750, "unit" => "ml", "is_popular" => false],
                ["volume" => 800, "unit" => "ml", "is_popular" => true],
                ["volume" => 900, "unit" => "ml", "is_popular" => false],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ekonomis & tahan lama",
                ],
                ["icon" => "bi-check-circle-fill", "text" => "Mudah dituang"],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk 3-4 orang",
                ],
            ],
            "modal_title" => "AROMAS Botol Standar",
            "modal_subtitle" => "Pilihan tepat untuk keluarga kecil Indonesia",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Botol HDPE"],
                ["label" => "Volume", "value" => "750ml - 900ml"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Ukuran ekonomis"],
                ["icon" => "bi-shield-check", "text" => "Praktis"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk Botol Standar",
            "order" => 2,
            "is_active" => true,
        ]);

        Product::create([
            "category_id" => 1, // Botol
            "name" => "AROMAS Botol Besar",
            "tagline" => "Hemat untuk keluarga besar",
            "badge_text" => "Keluarga Besar",
            "images" => [],
            "sizes" => [
                ["volume" => 1, "unit" => "liter", "is_popular" => false],
                ["volume" => 2, "unit" => "liter", "is_popular" => true],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Lebih hemat per liter",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Pegangan ergonomis",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk 5+ orang",
                ],
            ],
            "modal_title" => "AROMAS Botol Besar",
            "modal_subtitle" => "Solusi hemat untuk keluarga besar",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Botol HDPE dengan pegangan"],
                ["label" => "Volume", "value" => "1L - 2L"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Harga lebih hemat"],
                ["icon" => "bi-shield-check", "text" => "Pegangan kuat"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk Botol Besar",
            "order" => 3,
            "is_active" => true,
        ]);

        // JERIKEN CATEGORY PRODUCTS
        Product::create([
            "category_id" => 2, // Jeriken
            "name" => "AROMAS Jeriken Kecil",
            "tagline" => "Praktis untuk stok bulanan",
            "badge_text" => "Ekonomis",
            "images" => [],
            "sizes" => [
                ["volume" => 5, "unit" => "liter", "is_popular" => true],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Jeriken food-grade",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Tutup ulir rapat",
                ],
                ["icon" => "bi-check-circle-fill", "text" => "Mudah disimpan"],
            ],
            "modal_title" => "AROMAS Jeriken Kecil",
            "modal_subtitle" => "Stok minyak berkualitas untuk sebulan",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Jeriken HDPE"],
                ["label" => "Volume", "value" => "5 Liter"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Food-grade"],
                ["icon" => "bi-shield-check", "text" => "Tutup rapat"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk Jeriken Kecil",
            "order" => 1,
            "is_active" => true,
        ]);

        Product::create([
            "category_id" => 2, // Jeriken
            "name" => "AROMAS Jeriken Sedang",
            "tagline" => "Pas untuk keluarga besar",
            "badge_text" => "Rekomendasi",
            "images" => [],
            "sizes" => [
                ["volume" => 15, "unit" => "liter", "is_popular" => false],
                ["volume" => 18, "unit" => "liter", "is_popular" => true],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Handle kuat & ergonomis",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Dasar lebar & stabil",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk 6-8 orang",
                ],
            ],
            "modal_title" => "AROMAS Jeriken Sedang",
            "modal_subtitle" => "Pilihan tepat untuk keluarga besar",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Jeriken HDPE dengan handle"],
                ["label" => "Volume", "value" => "15L - 18L"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Handle ergonomis"],
                ["icon" => "bi-shield-check", "text" => "Stabil"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk Jeriken Sedang",
            "order" => 2,
            "is_active" => true,
        ]);

        Product::create([
            "category_id" => 2, // Jeriken
            "name" => "AROMAS Jeriken Besar",
            "tagline" => "Solusi hemat untuk restoran & katering",
            "badge_text" => "Komersial",
            "images" => [],
            "sizes" => [
                ["volume" => 20, "unit" => "liter", "is_popular" => true],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Harga lebih ekonomis/liter",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Tahan lama & kuat",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk UMKM",
                ],
            ],
            "modal_title" => "AROMAS Jeriken Besar",
            "modal_subtitle" => "Solusi komersial yang ekonomis",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Jeriken HDPE industrial"],
                ["label" => "Volume", "value" => "20 Liter"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Harga grosir"],
                ["icon" => "bi-shield-check", "text" => "Kuat & tahan lama"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk Jeriken Besar",
            "order" => 3,
            "is_active" => true,
        ]);

        // BIB CATEGORY PRODUCTS
        Product::create([
            "category_id" => 3, // BIB
            "name" => "AROMAS BIB Standar",
            "tagline" => "Sistem tap higienis untuk industri",
            "badge_text" => "Industri",
            "images" => [],
            "sizes" => [
                ["volume" => 15, "unit" => "liter", "is_popular" => false],
                ["volume" => 18, "unit" => "liter", "is_popular" => true],
            ],
            "features" => [
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Sistem tap mudah",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Kemasan sekunder box",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk HORECA",
                ],
            ],
            "modal_title" => "AROMAS BIB Standar",
            "modal_subtitle" => "Solusi higienis untuk industri makanan",
            "modal_details" => [
                ["label" => "Kemasan", "value" => "Bag in Box dengan tap"],
                ["label" => "Volume", "value" => "15L - 18L"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Tap higienis"],
                ["icon" => "bi-shield-check", "text" => "Box pelindung"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk BIB Standar",
            "order" => 1,
            "is_active" => true,
        ]);

        Product::create([
            "category_id" => 3, // BIB
            "name" => "AROMAS BIB Besar",
            "tagline" => "Kapasitas maksimal untuk produksi tinggi",
            "badge_text" => "Enterprise",
            "images" => [],
            "sizes" => [
                ["volume" => 20, "unit" => "liter", "is_popular" => true],
                ["volume" => 25, "unit" => "liter", "is_popular" => false],
            ],
            "features" => [
                ["icon" => "bi-check-circle-fill", "text" => "Volume maksimal"],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Harga termurah/liter",
                ],
                [
                    "icon" => "bi-check-circle-fill",
                    "text" => "Ideal untuk pabrik",
                ],
            ],
            "modal_title" => "AROMAS BIB Besar",
            "modal_subtitle" => "Solusi enterprise dengan harga terbaik",
            "modal_details" => [
                [
                    "label" => "Kemasan",
                    "value" => "Bag in Box industrial dengan tap",
                ],
                ["label" => "Volume", "value" => "20L - 25L"],
            ],
            "modal_features" => [
                ["icon" => "bi-dropbox", "text" => "Volume besar"],
                ["icon" => "bi-shield-check", "text" => "Harga terbaik"],
            ],
            "whatsapp_message" =>
                "Halo AROMAS, saya tertarik dengan produk BIB Besar",
            "order" => 2,
            "is_active" => true,
        ]);
    }
}
