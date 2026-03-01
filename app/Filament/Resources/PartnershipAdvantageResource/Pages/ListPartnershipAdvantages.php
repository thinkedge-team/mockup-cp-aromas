<?php
namespace App\Filament\Resources\PartnershipAdvantageResource\Pages;
use App\Filament\Resources\PartnershipAdvantageResource;
use Filament\Resources\Pages\ListRecords;
class ListPartnershipAdvantages extends ListRecords {
    protected static string $resource = PartnershipAdvantageResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; }
}
