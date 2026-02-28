<?php

namespace App\Filament\Resources\AboutCtaSettingResource\Pages;

use App\Filament\Resources\AboutCtaSettingResource;
use App\Models\AboutCtaSetting;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutCtaSetting extends ManageRecords
{
    protected static string $resource = AboutCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = AboutCtaSetting::first();

        if (!$record) {
            $record = AboutCtaSetting::create([
                'headline'      => 'Siap Bergabung Bersama Keluarga AROMAS?',
                'subtext'       => 'Jadilah bagian dari jutaan keluarga Indonesia yang mempercayai AROMAS setiap hari.',
                'button_1_text' => 'Lihat Produk',
                'button_1_url'  => '/#products',
                'button_2_text' => 'Hubungi Kami',
                'button_2_url'  => '/#contact',
                'is_active'     => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
