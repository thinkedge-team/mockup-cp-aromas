<?php

namespace App\Filament\Resources\ProductHeroResource\Pages;

use App\Filament\Resources\ProductHeroResource;
use App\Models\ProductHero;
use Filament\Resources\Pages\CreateRecord;

class CreateProductHero extends CreateRecord
{
    protected static string $resource = ProductHeroResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (ProductHero::exists()) {
            throw new \Exception('A product hero already exists. Please edit the existing record instead.');
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }
}
