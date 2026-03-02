<?php

namespace App\Filament\Resources\PortfolioMitraLogoResource\Pages;

use App\Filament\Resources\PortfolioMitraLogoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioMitraLogo extends EditRecord
{
    protected static string $resource = PortfolioMitraLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
