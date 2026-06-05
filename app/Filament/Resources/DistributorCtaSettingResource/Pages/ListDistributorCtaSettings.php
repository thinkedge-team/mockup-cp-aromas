<?php

namespace App\Filament\Resources\DistributorCtaSettingResource\Pages;

use App\Filament\Resources\DistributorCtaSettingResource;
use App\Models\DistributorCtaSetting;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributorCtaSettings extends ListRecords
{
    protected static string $resource = DistributorCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = DistributorCtaSetting::first();

        if (!$record) {
            $record = DistributorCtaSetting::create([
                'headline'    => 'Ingin Menjadi Bagian dari Kami?',
                'subtext'     => 'Bergabunglah menjadi distributor AROMAS dan dapatkan berbagai keuntungan menarik untuk bisnis Anda.',
                'button_text' => 'Daftar Distributor',
                'button_url'  => '/partnership',
                'is_active'   => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
