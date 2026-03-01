<?php

namespace App\Filament\Resources\ContactMapSettingResource\Pages;

use App\Filament\Resources\ContactMapSettingResource;
use App\Models\ContactMapSetting;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageContactMapSettings extends ManageRecords
{
    protected static string $resource = ContactMapSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    public function mount(): void
    {
        try {
            $record = ContactMapSetting::first() ?? ContactMapSetting::create([]);
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        } catch (\Exception $e) {
            Notification::make()->title('Gagal memuat data')->danger()->send();
        }
    }
}
