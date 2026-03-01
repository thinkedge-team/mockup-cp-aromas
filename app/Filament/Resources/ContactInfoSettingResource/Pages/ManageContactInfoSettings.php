<?php

namespace App\Filament\Resources\ContactInfoSettingResource\Pages;

use App\Filament\Resources\ContactInfoSettingResource;
use App\Models\ContactInfoSetting;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageContactInfoSettings extends ManageRecords
{
    protected static string $resource = ContactInfoSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    public function mount(): void
    {
        try {
            $record = ContactInfoSetting::first() ?? ContactInfoSetting::create([]);
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        } catch (\Exception $e) {
            Notification::make()->title('Gagal memuat data')->danger()->send();
        }
    }
}
