<?php

namespace App\Filament\Resources\PortfolioImpactStatResource\Pages;

use App\Filament\Resources\PortfolioImpactStatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioImpactStat extends EditRecord
{
    protected static string $resource = PortfolioImpactStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
