<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditContactMessage extends EditRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view')
                ->label('Lihat Detail')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn () => static::getResource()::getUrl('view', ['record' => $this->record])),

            Actions\DeleteAction::make()
                ->label('Hapus Pesan'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Follow-up disimpan')
            ->body('Status dan catatan pesan berhasil diperbarui.');
    }
}
