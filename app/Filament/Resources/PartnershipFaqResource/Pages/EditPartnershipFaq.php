<?php
namespace App\Filament\Resources\PartnershipFaqResource\Pages;
use App\Filament\Resources\PartnershipFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipFaq extends EditRecord {
    protected static string $resource = PartnershipFaqResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
