<?php

namespace App\Filament\Resources\AboutCtaSettingResource\Pages;

use App\Filament\Resources\AboutCtaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCtaSettings extends ListRecords
{
    protected static string $resource = AboutCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
