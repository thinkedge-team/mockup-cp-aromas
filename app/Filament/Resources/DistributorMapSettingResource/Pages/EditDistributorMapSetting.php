<?php

namespace App\Filament\Resources\DistributorMapSettingResource\Pages;

use App\Filament\Resources\DistributorMapSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorMapSetting extends EditRecord
{
    protected static string $resource = DistributorMapSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
