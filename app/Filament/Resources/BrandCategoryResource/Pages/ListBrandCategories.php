<?php

namespace App\Filament\Resources\BrandCategoryResource\Pages;

use App\Filament\Resources\BrandCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrandCategories extends ListRecords
{
    protected static string $resource = BrandCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
