<?php

namespace App\Filament\Resources\PromoHeroSettingResource\Pages;

use App\Filament\Resources\PromoHeroSettingResource;
use App\Models\PromoHeroSetting;
use Filament\Resources\Pages\ManageRecords;

class ManagePromoHeroSettings extends ManageRecords
{
    protected static string $resource = PromoHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $hero = PromoHeroSetting::first();

        if (!$hero) {
            // If no record exists, redirect to create
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        // Redirect to edit the existing record
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $hero]));
    }
}
