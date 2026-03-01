<?php
namespace App\Filament\Resources\PartnershipCtaSettingResource\Pages;
use App\Filament\Resources\PartnershipCtaSettingResource;
use App\Models\PartnershipCtaSetting;
use Filament\Resources\Pages\ManageRecords;
class ManagePartnershipCtaSetting extends ManageRecords {
    protected static string $resource = PartnershipCtaSettingResource::class;
    protected function getHeaderActions(): array { return []; }
    public function mount(): void {
        $record = PartnershipCtaSetting::first();
        if (!$record) {
            $record = PartnershipCtaSetting::create([
                'headline'      => 'Siap Memulai Perjalanan Kemitraan Anda?',
                'subtext'       => 'Bergabunglah dengan 500+ mitra sukses AROMAS di seluruh Indonesia. Konsultasi pertama selalu gratis.',
                'button_1_text' => 'Mulai Konsultasi',
                'wa_number'     => '6281234567890',
                'wa_message'    => 'Halo AROMAS, saya ingin bergabung sebagai mitra',
                'button_2_text' => 'Kirim Formulir',
                'button_2_url'  => '/contact',
                'is_active'     => true,
            ]);
        }
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
