<?php

namespace App\Filament\Resources\DistributorCtaSettingResource\Pages;

use App\Filament\Resources\DistributorCtaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorCtaSetting extends EditRecord
{
    protected static string $resource = DistributorCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
