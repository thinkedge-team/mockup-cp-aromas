<?php
namespace App\Filament\Resources\PartnershipHeroSettingResource\Pages;
use App\Filament\Resources\PartnershipHeroSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipHeroSetting extends EditRecord {
    protected static string $resource = PartnershipHeroSettingResource::class;
    protected function getHeaderActions(): array {
        return [Actions\DeleteAction::make()];
    }
    protected function getRedirectUrl(): string {
        return static::getResource()::getUrl('index');
    }
}
