<?php

namespace App\Filament\Resources\ContactHeroSettingResource\Pages;

use App\Filament\Resources\ContactHeroSettingResource;
use App\Models\ContactHeroSetting;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageContactHeroSettings extends ManageRecords
{
    protected static string $resource = ContactHeroSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    public function mount(): void
    {
        try {
            $record = ContactHeroSetting::first() ?? ContactHeroSetting::create([]);
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        } catch (\Exception $e) {
            Notification::make()->title('Gagal memuat data')->danger()->send();
        }
    }
}
