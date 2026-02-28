<?php
namespace App\Filament\Resources\PartnershipFaqResource\Pages;
use App\Filament\Resources\PartnershipFaqResource;
use Filament\Resources\Pages\ListRecords;
class ListPartnershipFaqs extends ListRecords {
    protected static string $resource = PartnershipFaqResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; }
}
