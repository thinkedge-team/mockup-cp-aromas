<?php

namespace App\Filament\Resources\AboutHeroSettingResource\Pages;

use App\Filament\Resources\AboutHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutHeroSetting extends EditRecord
{
    protected static string $resource = AboutHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
