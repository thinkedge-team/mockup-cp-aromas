<?php

namespace App\Filament\Resources\ContactWhySettingResource\Pages;

use App\Filament\Resources\ContactWhySettingResource;
use Filament\Resources\Pages\EditRecord;

class EditContactWhySetting extends EditRecord
{
    protected static string $resource = ContactWhySettingResource::class;

    protected function getHeaderActions(): array { return []; }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Mengapa Kami berhasil disimpan';
    }
}
