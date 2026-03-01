<?php
namespace App\Filament\Resources\PartnershipAdvantageResource\Pages;
use App\Filament\Resources\PartnershipAdvantageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipAdvantage extends EditRecord {
    protected static string $resource = PartnershipAdvantageResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
