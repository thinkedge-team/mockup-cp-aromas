<?php

namespace App\Filament\Resources\MissionSectionResource\Pages;

use App\Filament\Resources\MissionSectionResource;
use App\Models\MissionSection;
use Filament\Resources\Pages\CreateRecord;

class CreateMissionSection extends CreateRecord
{
    protected static string $resource = MissionSectionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Prevent creating if mission already exists
        if (MissionSection::exists()) {
            throw new \Exception('A mission section already exists. Please edit the existing record instead.');
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }
}
