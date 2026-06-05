<?php

namespace App\Filament\Resources\DistributorMapSettingResource\Pages;

use App\Filament\Resources\DistributorMapSettingResource;
use App\Models\DistributorMapSetting;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributorMapSettings extends ListRecords
{
    protected static string $resource = DistributorMapSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = DistributorMapSetting::first();

        if (!$record) {
            $record = DistributorMapSetting::create([
                'section_title'    => 'Peta <span class="italic">Distributor</span>',
                'section_subtitle' => 'Jelajahi jaringan distribusi kami yang tersebar di berbagai wilayah di Indonesia.',
                'is_active'        => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
