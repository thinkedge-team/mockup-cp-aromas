<?php

namespace App\Filament\Resources\AboutHeroSettingResource\Pages;

use App\Filament\Resources\AboutHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutHeroSettings extends ListRecords
{
    protected static string $resource = AboutHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
