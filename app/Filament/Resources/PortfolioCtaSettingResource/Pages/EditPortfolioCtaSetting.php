<?php

namespace App\Filament\Resources\PortfolioCtaSettingResource\Pages;

use App\Filament\Resources\PortfolioCtaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioCtaSetting extends EditRecord
{
    protected static string $resource = PortfolioCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(false),
        ];
    }
}
