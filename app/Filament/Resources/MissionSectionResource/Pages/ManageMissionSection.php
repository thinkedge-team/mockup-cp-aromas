<?php

namespace App\Filament\Resources\MissionSectionResource\Pages;

use App\Filament\Resources\MissionSectionResource;
use App\Models\MissionSection;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMissionSection extends ManageRecords
{
    protected static string $resource = MissionSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Mission Section')
                ->modalHeading('Create Mission Section')
                ->modalDescription('Only one mission section can exist.')
                ->mutateFormDataUsing(function (array $data) {
                    // Check if mission section already exists
                    if (MissionSection::exists()) {
                        throw new \Exception('A mission section already exists. Please edit the existing record instead.');
                    }
                    return $data;
                })
                ->successRedirectUrl(static::getUrl()),
        ];
    }

    public function mount(): void
    {
        // If no mission section exists, redirect to create
        if (!MissionSection::exists()) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        // If mission exists, redirect to edit page
        $mission = MissionSection::first();
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $mission]));
    }
}
