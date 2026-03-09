<?php

namespace App\Filament\Resources\PortfolioSettingResource\Pages;

use App\Filament\Resources\PortfolioSettingResource;
use App\Models\PortfolioSetting;
use Filament\Resources\Pages\ManageRecords;

class ManagePortfolioSetting extends ManageRecords
{
    protected static string $resource = PortfolioSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $setting = PortfolioSetting::first();

        if (!$setting) {
            // Create default setting if none exists
            $setting = PortfolioSetting::create([
                'badge_text' => 'Portofolio Kemitraan',
                'badge_icon' => 'bi-briefcase-fill',
                'title' => 'Dipercaya Ribuan Mitra',
                'title_emphasis' => 'Di Seluruh Indonesia',
                'description' => 'Dari UMKM hingga korporasi besar — AROMAS bangga menjadi bagian dari ribuan kisah sukses mitra bisnis kami di berbagai sektor industri.',
                'stats' => [
                    ['icon' => 'bi-people-fill', 'number' => '1Jt+', 'label' => 'Pelanggan Setia'],
                    ['icon' => 'bi-building', 'number' => '500+', 'label' => 'Mitra Distribusi'],
                    ['icon' => 'bi-geo-alt-fill', 'number' => '34', 'label' => 'Provinsi Terjangkau'],
                    ['icon' => 'bi-star-fill', 'number' => '4.9/5', 'label' => 'Rating Kepuasan'],
                ],
                'is_active' => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $setting]));
    }
}
