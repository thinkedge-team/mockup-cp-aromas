<?php

namespace App\Filament\Resources\PromoHeroSettingResource\Pages;

use App\Filament\Resources\PromoHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromoHeroSettings extends ListRecords
{
    protected static string $resource = PromoHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
