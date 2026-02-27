<?php

namespace App\Filament\Resources\PromoFilterCategoryResource\Pages;

use App\Filament\Resources\PromoFilterCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromoFilterCategory extends EditRecord
{
    protected static string $resource = PromoFilterCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
