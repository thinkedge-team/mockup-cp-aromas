<?php

namespace App\Filament\Resources\VideoSettingResource\Pages;

use App\Filament\Resources\VideoSettingResource;
use App\Models\VideoSetting;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVideoSetting extends ManageRecords
{
    protected static string $resource = VideoSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Video Setting')
                ->modalHeading('Create Video Setting')
                ->modalDescription('Only one video setting can exist.')
                ->mutateFormDataUsing(function (array $data) {
                    // Check if video setting already exists
                    if (VideoSetting::exists()) {
                        throw new \Exception('A video setting already exists. Please edit the existing record instead.');
                    }
                    return $data;
                })
                ->successRedirectUrl(static::getUrl()),
        ];
    }

    public function mount(): void
    {
        // If no video setting exists, redirect to create
        if (!VideoSetting::exists()) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        // If video exists, redirect to edit page
        $video = VideoSetting::first();
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $video]));
    }
}
