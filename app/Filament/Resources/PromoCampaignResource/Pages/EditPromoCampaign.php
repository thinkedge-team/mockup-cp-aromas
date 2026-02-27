<?php

namespace App\Filament\Resources\PromoCampaignResource\Pages;

use App\Filament\Resources\PromoCampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromoCampaign extends EditRecord
{
    protected static string $resource = PromoCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
