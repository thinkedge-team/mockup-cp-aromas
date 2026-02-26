<?php

namespace App\Filament\Resources\ProductAdvantageResource\Pages;

use App\Filament\Resources\ProductAdvantageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductAdvantages extends ListRecords
{
    protected static string $resource = ProductAdvantageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
