<?php

namespace App\Filament\Resources\PromoFilterCategoryResource\Pages;

use App\Filament\Resources\PromoFilterCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromoFilterCategories extends ListRecords
{
    protected static string $resource = PromoFilterCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
