<?php

namespace App\Filament\Resources\ContactInfoSettingResource\Pages;

use App\Filament\Resources\ContactInfoSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditContactInfoSetting extends EditRecord
{
    protected static string $resource = ContactInfoSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Info Kontak berhasil disimpan';
    }
}
