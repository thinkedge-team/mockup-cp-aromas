<?php
namespace App\Filament\Resources\PartnershipProgramResource\Pages;
use App\Filament\Resources\PartnershipProgramResource;
use Filament\Resources\Pages\ListRecords;
class ListPartnershipPrograms extends ListRecords {
    protected static string $resource = PartnershipProgramResource::class;
    protected function getHeaderActions(): array { return []; }
}
