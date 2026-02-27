<?php

namespace App\Filament\Resources\MachineCtaResource\Pages;

use App\Filament\Resources\MachineCtaResource;
use App\Models\MachineCta;
use Filament\Resources\Pages\CreateRecord;

class CreateMachineCta extends CreateRecord
{
    protected static string $resource = MachineCtaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (MachineCta::exists()) {
            $this->redirect(static::getResource()::getUrl('edit', ['record' => MachineCta::first()]));
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('edit', ['record' => $this->record]);
    }
}
