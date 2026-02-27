<?php

namespace App\Filament\Resources\CapacityStatResource\Pages;

use App\Filament\Resources\CapacityStatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCapacityStat extends EditRecord
{
    protected static string $resource = CapacityStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
