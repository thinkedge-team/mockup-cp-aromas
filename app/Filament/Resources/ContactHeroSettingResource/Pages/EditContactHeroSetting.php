<?php

namespace App\Filament\Resources\ContactHeroSettingResource\Pages;

use App\Filament\Resources\ContactHeroSettingResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditContactHeroSetting extends EditRecord
{
    protected static string $resource = ContactHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Hero Section berhasil disimpan';
    }
}
