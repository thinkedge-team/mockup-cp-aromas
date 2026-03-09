<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('follow_up')
                ->label('Follow-up / Edit Status')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('warning')
                ->url(fn () => static::getResource()::getUrl('edit', ['record' => $this->record])),

            Actions\DeleteAction::make()
                ->label('Hapus Pesan'),
        ];
    }
}
