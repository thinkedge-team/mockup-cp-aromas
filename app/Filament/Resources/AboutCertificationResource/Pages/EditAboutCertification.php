<?php

namespace App\Filament\Resources\AboutCertificationResource\Pages;

use App\Filament\Resources\AboutCertificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutCertification extends EditRecord
{
    protected static string $resource = AboutCertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
