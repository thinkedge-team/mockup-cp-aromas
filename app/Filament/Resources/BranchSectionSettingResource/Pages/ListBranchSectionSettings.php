<?php

namespace App\Filament\Resources\BranchSectionSettingResource\Pages;

use App\Filament\Resources\BranchSectionSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBranchSectionSettings extends ListRecords
{
    protected static string $resource = BranchSectionSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
