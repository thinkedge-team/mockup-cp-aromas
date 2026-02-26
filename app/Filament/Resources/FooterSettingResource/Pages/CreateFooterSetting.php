<?php

namespace App\Filament\Resources\FooterSettingResource\Pages;

use App\Filament\Resources\FooterSettingResource;
use App\Models\FooterSetting;
use Filament\Resources\Pages\CreateRecord;

class CreateFooterSetting extends CreateRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Prevent creating if footer already exists
        if (FooterSetting::exists()) {
            throw new \Exception('A footer setting already exists. Please edit the existing record instead.');
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }
}
