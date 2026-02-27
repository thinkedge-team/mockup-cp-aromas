<?php

namespace App\Filament\Resources\MachineHeroResource\Pages;

use App\Filament\Resources\MachineHeroResource;
use App\Models\MachineHero;
use Filament\Resources\Pages\CreateRecord;

class CreateMachineHero extends CreateRecord
{
    protected static string $resource = MachineHeroResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (MachineHero::exists()) {
            // Redirect to edit if record already exists
            $this->redirect(static::getResource()::getUrl('edit', ['record' => MachineHero::first()]));
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('edit', ['record' => $this->record]);
    }
}
