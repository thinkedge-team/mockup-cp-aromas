<?php

namespace App\Filament\Resources\PromoCampaignResource\Pages;

use App\Filament\Resources\PromoCampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromoCampaigns extends ListRecords
{
    protected static string $resource = PromoCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
