<?php
namespace App\Filament\Resources\PartnershipHeroSettingResource\Pages;
use App\Filament\Resources\PartnershipHeroSettingResource;
use App\Models\PartnershipHeroSetting;
use Filament\Resources\Pages\ManageRecords;
class ManagePartnershipHeroSetting extends ManageRecords {
    protected static string $resource = PartnershipHeroSettingResource::class;
    protected function getHeaderActions(): array { return []; }
    public function mount(): void {
        $record = PartnershipHeroSetting::first();
        if (!$record) {
            $record = PartnershipHeroSetting::create([
                'badge_text'  => 'Program Kemitraan AROMAS',
                'title_main'  => 'Tumbuh Bersama Kami,',
                'title_italic'=> 'Raih Sukses Bersama',
                'description' => 'Bergabunglah dengan ribuan mitra sukses AROMAS di seluruh Indonesia.',
                'wa_number'   => '6281234567890',
                'is_active'   => true,
            ]);
        }
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
