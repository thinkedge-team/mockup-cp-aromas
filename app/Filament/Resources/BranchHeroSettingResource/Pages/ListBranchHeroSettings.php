<?php

namespace App\Filament\Resources\BranchHeroSettingResource\Pages;

use App\Filament\Resources\BranchHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBranchHeroSettings extends ListRecords
{
    protected static string $resource = BranchHeroSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
