<?php

namespace App\Filament\Resources\ContactCtaSettingResource\Pages;

use App\Filament\Resources\ContactCtaSettingResource;
use App\Models\ContactCtaSetting;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageContactCtaSettings extends ManageRecords
{
    protected static string $resource = ContactCtaSettingResource::class;

    protected function getHeaderActions(): array { return []; }

    public function mount(): void
    {
        try {
            $record = ContactCtaSetting::first() ?? ContactCtaSetting::create([]);
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        } catch (\Exception $e) {
            Notification::make()->title('Gagal memuat data')->danger()->send();
        }
    }
}
