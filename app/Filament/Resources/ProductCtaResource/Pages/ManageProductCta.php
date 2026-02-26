<?php

namespace App\Filament\Resources\ProductCtaResource\Pages;

use App\Filament\Resources\ProductCtaResource;
use App\Models\ProductCta;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProductCta extends ManageRecords
{
    protected static string $resource = ProductCtaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Product CTA')
                ->modalHeading('Create Product CTA')
                ->modalDescription('Only one product CTA can exist.')
                ->mutateFormDataUsing(function (array $data) {
                    if (ProductCta::exists()) {
                        throw new \Exception('A product CTA already exists. Please edit the existing record instead.');
                    }
                    return $data;
                })
                ->successRedirectUrl(static::getUrl()),
        ];
    }

    public function mount(): void
    {
        if (!ProductCta::exists()) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        $cta = ProductCta::first();
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $cta]));
    }
}
