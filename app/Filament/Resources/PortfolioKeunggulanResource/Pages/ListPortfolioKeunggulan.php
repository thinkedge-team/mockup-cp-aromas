<?php

namespace App\Filament\Resources\PortfolioKeunggulanResource\Pages;

use App\Filament\Resources\PortfolioKeunggulanResource;
use App\Models\PortfolioKeunggulan;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioKeunggulan extends ListRecords
{
    protected static string $resource = PortfolioKeunggulanResource::class;

    public function mount(): void
    {
        if (PortfolioKeunggulan::count() === 0) {
            $this->seedDefaultKeunggulan();
        }
    }

    private function seedDefaultKeunggulan(): void
    {
        PortfolioKeunggulan::create([
            'icon' => 'bi-award-fill',
            'title' => 'Halal & Bersertifikat',
            'description' => 'Sertifikasi Halal MUI, BPOM RI, dan ISO 22000 — jaminan keamanan pangan tanpa kompromi.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioKeunggulan::create([
            'icon' => 'bi-truck',
            'title' => 'Pengiriman Tepat Waktu',
            'description' => 'Jaringan logistik luas dengan tingkat ketepatan pengiriman 99% ke seluruh Indonesia.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioKeunggulan::create([
            'icon' => 'bi-headset',
            'title' => 'Dukungan 24/7',
            'description' => 'Tim sales dan customer service siap membantu pertanyaan, pesanan, dan solusi bisnis Anda.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        PortfolioKeunggulan::create([
            'icon' => 'bi-graph-up-arrow',
            'title' => 'Harga Kompetitif',
            'description' => 'Program harga khusus untuk mitra volume tinggi dengan kontrak jangka panjang yang menguntungkan.',
            'sort_order' => 4,
            'is_active' => true,
        ]);
    }
}
