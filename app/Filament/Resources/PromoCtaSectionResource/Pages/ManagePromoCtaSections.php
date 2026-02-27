<?php

namespace App\Filament\Resources\PromoCtaSectionResource\Pages;

use App\Filament\Resources\PromoCtaSectionResource;
use App\Models\PromoCtaSection;
use Filament\Resources\Pages\ManageRecords;

class ManagePromoCtaSections extends ManageRecords
{
    protected static string $resource = PromoCtaSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $cta = PromoCtaSection::first();

        if (!$cta) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $cta]));
    }
}
