<?php

namespace App\Filament\Resources\ContactFaqResource\Pages;

use App\Filament\Resources\ContactFaqResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactFaq extends CreateRecord
{
    protected static string $resource = ContactFaqResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
