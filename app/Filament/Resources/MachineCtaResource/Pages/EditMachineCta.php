<?php

namespace App\Filament\Resources\MachineCtaResource\Pages;

use App\Filament\Resources\MachineCtaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMachineCta extends EditRecord
{
    protected static string $resource = MachineCtaResource::class;

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
