<?php
namespace App\Filament\Resources\PartnershipCtaSettingResource\Pages;
use App\Filament\Resources\PartnershipCtaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipCtaSetting extends EditRecord {
    protected static string $resource = PartnershipCtaSettingResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
