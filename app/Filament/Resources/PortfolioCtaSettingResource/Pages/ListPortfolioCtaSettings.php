<?php

namespace App\Filament\Resources\PortfolioCtaSettingResource\Pages;

use App\Filament\Resources\PortfolioCtaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioCtaSettings extends ListRecords
{
    protected static string $resource = PortfolioCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
