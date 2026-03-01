<?php

namespace App\Filament\Resources\AboutVmSettingResource\Pages;

use App\Filament\Resources\AboutVmSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutVmSetting extends EditRecord
{
    protected static string $resource = AboutVmSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
