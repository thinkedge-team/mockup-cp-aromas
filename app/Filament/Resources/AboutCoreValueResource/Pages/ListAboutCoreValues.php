<?php

namespace App\Filament\Resources\AboutCoreValueResource\Pages;

use App\Filament\Resources\AboutCoreValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCoreValues extends ListRecords
{
    protected static string $resource = AboutCoreValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
