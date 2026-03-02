<?php

namespace App\Filament\Resources\PortfolioMitraLogoResource\Pages;

use App\Filament\Resources\PortfolioMitraLogoResource;
use App\Models\PortfolioMitraLogo;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioMitraLogos extends ListRecords
{
    protected static string $resource = PortfolioMitraLogoResource::class;

    public function mount(): void
    {
        if (PortfolioMitraLogo::count() === 0) {
            $this->seedDefaultMitraLogos();
        }
    }

    private function seedDefaultMitraLogos(): void
    {
        PortfolioMitraLogo::create(['name' => 'Indomaret', 'logo' => null, 'url' => null, 'sort_order' => 1, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Alfamart', 'logo' => null, 'url' => null, 'sort_order' => 2, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Hypermart', 'logo' => null, 'url' => null, 'sort_order' => 3, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Giant', 'logo' => null, 'url' => null, 'sort_order' => 4, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Superindo', 'logo' => null, 'url' => null, 'sort_order' => 5, 'is_active' => true]);
        PortfolioMitraLogo::create(['name' => 'Tokopedia', 'logo' => null, 'url' => null, 'sort_order' => 6, 'is_active' => true]);
    }
}
