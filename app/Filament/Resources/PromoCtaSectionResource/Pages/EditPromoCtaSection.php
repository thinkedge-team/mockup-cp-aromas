<?php

namespace App\Filament\Resources\PromoCtaSectionResource\Pages;

use App\Filament\Resources\PromoCtaSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromoCtaSection extends EditRecord
{
    protected static string $resource = PromoCtaSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
