<?php

namespace App\Filament\Resources\BlogSettingResource\Pages;

use App\Filament\Resources\BlogSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogSetting extends CreateRecord
{
    protected static string $resource = BlogSettingResource::class;
}
