<?php

namespace App\Filament\Resources\PromoHowtoSectionResource\Pages;

use App\Filament\Resources\PromoHowtoSectionResource;
use App\Models\PromoHowtoSection;
use Filament\Resources\Pages\ManageRecords;

class ManagePromoHowtoSections extends ManageRecords
{
    protected static string $resource = PromoHowtoSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $howto = PromoHowtoSection::first();

        if (!$howto) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $howto]));
    }
}
