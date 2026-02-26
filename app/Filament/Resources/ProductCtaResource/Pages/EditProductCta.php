<?php

namespace App\Filament\Resources\ProductCtaResource\Pages;

use App\Filament\Resources\ProductCtaResource;
use Filament\Resources\Pages\EditRecord;

class EditProductCta extends EditRecord
{
    protected static string $resource = ProductCtaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
