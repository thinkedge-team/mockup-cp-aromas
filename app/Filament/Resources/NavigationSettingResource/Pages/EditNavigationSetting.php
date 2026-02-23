<?php

namespace App\Filament\Resources\NavigationSettingResource\Pages;

use App\Filament\Resources\NavigationSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNavigationSetting extends EditRecord
{
    protected static string $resource = NavigationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
