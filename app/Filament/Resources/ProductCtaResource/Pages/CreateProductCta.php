<?php

namespace App\Filament\Resources\ProductCtaResource\Pages;

use App\Filament\Resources\ProductCtaResource;
use App\Models\ProductCta;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCta extends CreateRecord
{
    protected static string $resource = ProductCtaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (ProductCta::exists()) {
            throw new \Exception('A product CTA already exists. Please edit the existing record instead.');
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl();
    }
}
