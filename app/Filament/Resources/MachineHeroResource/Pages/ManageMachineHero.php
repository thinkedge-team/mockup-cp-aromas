<?php

namespace App\Filament\Resources\MachineHeroResource\Pages;

use App\Filament\Resources\MachineHeroResource;
use App\Models\MachineHero;
use Filament\Resources\Pages\ManageRecords;

class ManageMachineHero extends ManageRecords
{
    protected static string $resource = MachineHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $hero = MachineHero::first();
        
        if (!$hero) {
            // If no record exists, redirect to create (shouldn't happen with seeder)
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }
        
        // Redirect to edit the existing record
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $hero]));
    }
}
