<?php

namespace App\Filament\Resources\PromoHowtoSectionResource\Pages;

use App\Filament\Resources\PromoHowtoSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromoHowtoSection extends EditRecord
{
    protected static string $resource = PromoHowtoSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
