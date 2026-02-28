<?php

namespace App\Filament\Resources\AboutHeroSettingResource\Pages;

use App\Filament\Resources\AboutHeroSettingResource;
use App\Models\AboutHeroSetting;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutHeroSetting extends ManageRecords
{
    protected static string $resource = AboutHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = AboutHeroSetting::first();

        if (!$record) {
            // Auto-create default if none exists
            $record = AboutHeroSetting::create([
                'badge_text'   => 'Perjalanan Kami',
                'title_main'   => 'Menghadirkan Kualitas',
                'title_italic' => 'Terbaik Untuk Indonesia',
                'description'  => 'Sejak didirikan, AROMAS berdedikasi untuk menciptakan produk minyak goreng yang tidak hanya lezat, tetapi juga sehat dan berkelanjutan bagi setiap keluarga.',
                'stats'        => [
                    ['value' => '15+', 'label' => 'Tahun Berdiri'],
                    ['value' => '1Jt+', 'label' => 'Pelanggan Setia'],
                    ['value' => '34', 'label' => 'Provinsi'],
                    ['value' => '500+', 'label' => 'Mitra Distribusi'],
                ],
                'is_active' => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
