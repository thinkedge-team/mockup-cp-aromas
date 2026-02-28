<?php

namespace App\Filament\Resources\ContactCtaSettingResource\Pages;

use App\Filament\Resources\ContactCtaSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditContactCtaSetting extends EditRecord
{
    protected static string $resource = ContactCtaSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'CTA Strip berhasil disimpan';
    }
}
