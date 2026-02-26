<?php

namespace App\Filament\Resources\ProductAdvantageResource\Pages;

use App\Filament\Resources\ProductAdvantageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductAdvantage extends EditRecord
{
    protected static string $resource = ProductAdvantageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
