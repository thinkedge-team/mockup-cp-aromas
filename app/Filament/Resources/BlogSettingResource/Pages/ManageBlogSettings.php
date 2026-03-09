<?php

namespace App\Filament\Resources\BlogSettingResource\Pages;

use App\Filament\Resources\BlogSettingResource;
use App\Models\BlogSetting;
use Filament\Resources\Pages\ManageRecords;

class ManageBlogSettings extends ManageRecords
{
    protected static string $resource = BlogSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $setting = BlogSetting::first();

        if (!$setting) {
            $this->redirect(static::getResource()::getUrl('create'));
            return;
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $setting]));
    }
}
