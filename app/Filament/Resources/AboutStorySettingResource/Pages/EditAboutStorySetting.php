<?php

namespace App\Filament\Resources\AboutStorySettingResource\Pages;

use App\Filament\Resources\AboutStorySettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutStorySetting extends EditRecord
{
    protected static string $resource = AboutStorySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
