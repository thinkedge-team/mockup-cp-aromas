<?php

namespace App\Filament\Resources\AboutCertificationResource\Pages;

use App\Filament\Resources\AboutCertificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCertifications extends ListRecords
{
    protected static string $resource = AboutCertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
