<?php

namespace App\Filament\Resources\CapacityStatResource\Pages;

use App\Filament\Resources\CapacityStatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCapacityStats extends ListRecords
{
    protected static string $resource = CapacityStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
