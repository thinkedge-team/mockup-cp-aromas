<?php

namespace App\Filament\Resources\FooterSettingResource\Pages;

use App\Filament\Resources\FooterSettingResource;
use App\Models\FooterSetting;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFooterSetting extends ManageRecords
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Footer Setting')
                ->modalHeading('Create Footer Setting')
                ->modalDescription('Only one footer setting can exist.')
                ->mutateFormDataUsing(function (array $data) {
                    // Check if footer setting already exists
                    if (FooterSetting::exists()) {
                        throw new \Exception('A footer setting already exists. Please edit the existing record instead.');
                    }
                    return $data;
                })
                ->successRedirectUrl(static::getUrl()),
        ];
    }

    public function mount(): void
    {
        // If no footer setting exists, redirect to create
        if (!FooterSetting::exists()) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        // If footer exists, redirect to edit page
        $footer = FooterSetting::first();
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $footer]));
    }
}
