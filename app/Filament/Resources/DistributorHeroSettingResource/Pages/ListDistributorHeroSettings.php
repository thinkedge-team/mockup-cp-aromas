<?php

namespace App\Filament\Resources\DistributorHeroSettingResource\Pages;

use App\Filament\Resources\DistributorHeroSettingResource;
use App\Models\DistributorHeroSetting;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributorHeroSettings extends ListRecords
{
    protected static string $resource = DistributorHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = DistributorHeroSetting::first();

        if (!$record) {
            $record = DistributorHeroSetting::create([
                'badge_text'   => 'Jaringan Distribusi',
                'title_main'   => 'Hadir Lebih Dekat',
                'title_italic' => 'Di Seluruh Indonesia',
                'description'  => 'Minyak goreng AROMAS kini mudah didapatkan di berbagai wilayah. Temukan distributor resmi kami di kota Anda untuk menjamin kualitas dan keaslian produk.',
                'stats'        => [
                    ['value' => '34', 'label' => 'Provinsi'],
                    ['value' => '500+', 'label' => 'Distributor Resmi'],
                    ['value' => '1.000+', 'label' => 'Toko Ritel'],
                ],
                'is_active' => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
