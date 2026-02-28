<?php

namespace App\Filament\Resources\ContactFaqResource\Pages;

use App\Filament\Resources\ContactFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactFaq extends EditRecord
{
    protected static string $resource = ContactFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
