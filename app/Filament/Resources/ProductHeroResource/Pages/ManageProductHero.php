<?php

namespace App\Filament\Resources\ProductHeroResource\Pages;

use App\Filament\Resources\ProductHeroResource;
use App\Models\ProductHero;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProductHero extends ManageRecords
{
    protected static string $resource = ProductHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Product Hero')
                ->modalHeading('Create Product Hero')
                ->modalDescription('Only one product hero can exist.')
                ->mutateFormDataUsing(function (array $data) {
                    if (ProductHero::exists()) {
                        throw new \Exception('A product hero already exists. Please edit the existing record instead.');
                    }
                    return $data;
                })
                ->successRedirectUrl(static::getUrl()),
        ];
    }

    public function mount(): void
    {
        if (!ProductHero::exists()) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        $hero = ProductHero::first();
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $hero]));
    }
}
