<?php

namespace App\Filament\Resources\BlogSettingResource\Pages;

use App\Filament\Resources\BlogSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogSetting extends EditRecord
{
    protected static string $resource = BlogSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
