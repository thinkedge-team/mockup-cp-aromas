<?php

namespace App\Filament\Resources\MachineCtaResource\Pages;

use App\Filament\Resources\MachineCtaResource;
use App\Models\MachineCta;
use Filament\Resources\Pages\ManageRecords;

class ManageMachineCta extends ManageRecords
{
    protected static string $resource = MachineCtaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $cta = MachineCta::first();
        
        if (!$cta) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }
        
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $cta]));
    }
}
