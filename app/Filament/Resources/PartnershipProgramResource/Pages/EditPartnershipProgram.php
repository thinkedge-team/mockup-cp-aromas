<?php
namespace App\Filament\Resources\PartnershipProgramResource\Pages;
use App\Filament\Resources\PartnershipProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartnershipProgram extends EditRecord {
    protected static string $resource = PartnershipProgramResource::class;
    protected function getHeaderActions(): array { return []; }
    protected function getRedirectUrl(): string { return static::getResource()::getUrl('index'); }
}
