<?php

namespace App\Filament\Resources\PromoCtaSectionResource\Pages;

use App\Filament\Resources\PromoCtaSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromoCtaSections extends ListRecords
{
    protected static string $resource = PromoCtaSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
