<?php

namespace App\Filament\Resources\PromoHeroSettingResource\Pages;

use App\Filament\Resources\PromoHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromoHeroSetting extends EditRecord
{
    protected static string $resource = PromoHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
