<?php

namespace App\Filament\Resources\PortfolioKeunggulanResource\Pages;

use App\Filament\Resources\PortfolioKeunggulanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioKeunggulan extends EditRecord
{
    protected static string $resource = PortfolioKeunggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
