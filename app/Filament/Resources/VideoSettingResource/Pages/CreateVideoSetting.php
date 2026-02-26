<?php

namespace App\Filament\Resources\VideoSettingResource\Pages;

use App\Filament\Resources\VideoSettingResource;
use App\Models\VideoSetting;
use Filament\Resources\Pages\CreateRecord;

class CreateVideoSetting extends CreateRecord
{
    protected static string $resource = VideoSettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Prevent creating if video setting already exists
        if (VideoSetting::exists()) {
            throw new \Exception('A video setting already exists. Please edit the existing record instead.');
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }
}
