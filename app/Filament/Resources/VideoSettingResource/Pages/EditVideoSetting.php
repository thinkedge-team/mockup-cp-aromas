<?php

namespace App\Filament\Resources\VideoSettingResource\Pages;

use App\Filament\Resources\VideoSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditVideoSetting extends EditRecord
{
    protected static string $resource = VideoSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
