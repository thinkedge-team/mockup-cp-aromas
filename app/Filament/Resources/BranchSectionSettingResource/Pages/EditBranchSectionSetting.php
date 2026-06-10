<?php

namespace App\Filament\Resources\BranchSectionSettingResource\Pages;

use App\Filament\Resources\BranchSectionSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBranchSectionSetting extends EditRecord
{
    protected static string $resource = BranchSectionSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
