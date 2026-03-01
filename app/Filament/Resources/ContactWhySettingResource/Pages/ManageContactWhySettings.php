<?php

namespace App\Filament\Resources\ContactWhySettingResource\Pages;

use App\Filament\Resources\ContactWhySettingResource;
use App\Models\ContactWhySetting;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageContactWhySettings extends ManageRecords
{
    protected static string $resource = ContactWhySettingResource::class;

    protected function getHeaderActions(): array { return []; }

    public function mount(): void
    {
        try {
            $record = ContactWhySetting::first() ?? ContactWhySetting::create([]);
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        } catch (\Exception $e) {
            Notification::make()->title('Gagal memuat data')->danger()->send();
        }
    }
}
