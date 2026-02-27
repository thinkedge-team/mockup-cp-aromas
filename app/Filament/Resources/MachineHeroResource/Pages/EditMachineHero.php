<?php

namespace App\Filament\Resources\MachineHeroResource\Pages;

use App\Filament\Resources\MachineHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMachineHero extends EditRecord
{
    protected static string $resource = MachineHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No delete action - single record cannot be deleted
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('edit', ['record' => $this->record]);
    }
}
