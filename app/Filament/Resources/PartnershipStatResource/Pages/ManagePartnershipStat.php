<?php
namespace App\Filament\Resources\PartnershipStatResource\Pages;
use App\Filament\Resources\PartnershipStatResource;
use App\Models\PartnershipStat;
use Filament\Resources\Pages\ManageRecords;
class ManagePartnershipStat extends ManageRecords {
    protected static string $resource = PartnershipStatResource::class;
    protected function getHeaderActions(): array { return []; }
    public function mount(): void {
        $record = PartnershipStat::first();
        if (!$record) {
            $record = PartnershipStat::create([
                'stats' => [
                    ['value' => '500', 'suffix' => '+', 'label' => 'Mitra Aktif'],
                    ['value' => '34',  'suffix' => '',  'label' => 'Provinsi Terjangkau'],
                    ['value' => '15',  'suffix' => '+', 'label' => 'Tahun Pengalaman'],
                    ['value' => '98',  'suffix' => '%', 'label' => 'Kepuasan Mitra'],
                ],
                'is_active' => true,
            ]);
        }
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
