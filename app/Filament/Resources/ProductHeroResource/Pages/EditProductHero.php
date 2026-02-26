<?php

namespace App\Filament\Resources\ProductHeroResource\Pages;

use App\Filament\Resources\ProductHeroResource;
use Filament\Resources\Pages\EditRecord;

class EditProductHero extends EditRecord
{
    protected static string $resource = ProductHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
