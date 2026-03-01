<?php

namespace App\Filament\Resources\ContactMapSettingResource\Pages;

use App\Filament\Resources\ContactMapSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditContactMapSetting extends EditRecord
{
    protected static string $resource = ContactMapSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Peta & Lokasi berhasil disimpan';
    }
}
