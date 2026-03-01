<?php
namespace App\Filament\Resources\PartnershipStatResource\Pages;
use App\Filament\Resources\PartnershipStatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipStat extends EditRecord {
    protected static string $resource = PartnershipStatResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
