<?php

namespace App\Filament\Resources\PortfolioImpactStatResource\Pages;

use App\Filament\Resources\PortfolioImpactStatResource;
use App\Models\PortfolioImpactStat;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioImpactStats extends ListRecords
{
    protected static string $resource = PortfolioImpactStatResource::class;

    public function mount(): void
    {
        if (PortfolioImpactStat::count() === 0) {
            $this->seedDefaultImpactStats();
        }
    }

    private function seedDefaultImpactStats(): void
    {
        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=160&fit=crop',
            'number' => '15',
            'label' => 'Tahun Pengalaman',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=300&h=160&fit=crop',
            'number' => '500',
            'label' => 'Mitra Distribusi',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1466637574441-749b8f19452f?w=300&h=160&fit=crop',
            'number' => '34',
            'label' => 'Provinsi Terjangkau',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        PortfolioImpactStat::create([
            'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=300&h=160&fit=crop',
            'number' => '1000000',
            'label' => 'Pelanggan Setia',
            'sort_order' => 4,
            'is_active' => true,
        ]);
    }
}
