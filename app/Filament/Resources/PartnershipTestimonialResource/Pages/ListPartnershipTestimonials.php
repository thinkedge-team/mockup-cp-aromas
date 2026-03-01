<?php
namespace App\Filament\Resources\PartnershipTestimonialResource\Pages;
use App\Filament\Resources\PartnershipTestimonialResource;
use Filament\Resources\Pages\ListRecords;
class ListPartnershipTestimonials extends ListRecords {
    protected static string $resource = PartnershipTestimonialResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; }
}
