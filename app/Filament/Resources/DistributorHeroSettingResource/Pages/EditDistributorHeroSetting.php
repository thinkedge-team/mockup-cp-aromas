<?php

namespace App\Filament\Resources\DistributorHeroSettingResource\Pages;

use App\Filament\Resources\DistributorHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorHeroSetting extends EditRecord
{
    protected static string $resource = DistributorHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
