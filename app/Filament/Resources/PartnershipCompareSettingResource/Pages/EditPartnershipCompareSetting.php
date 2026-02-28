<?php
namespace App\Filament\Resources\PartnershipCompareSettingResource\Pages;
use App\Filament\Resources\PartnershipCompareSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipCompareSetting extends EditRecord {
    protected static string $resource = PartnershipCompareSettingResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
