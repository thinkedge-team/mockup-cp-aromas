<?php
namespace App\Filament\Resources\PartnershipTestimonialResource\Pages;
use App\Filament\Resources\PartnershipTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipTestimonial extends EditRecord {
    protected static string $resource = PartnershipTestimonialResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
