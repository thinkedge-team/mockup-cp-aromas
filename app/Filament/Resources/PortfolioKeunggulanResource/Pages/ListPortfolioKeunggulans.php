<?php

namespace App\Filament\Resources\PortfolioKeunggulanResource\Pages;

use App\Filament\Resources\PortfolioKeunggulanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioKeunggulans extends ListRecords
{
    protected static string $resource = PortfolioKeunggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
