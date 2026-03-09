<?php

namespace App\Filament\Resources\PortfolioCtaSettingResource\Pages;

use App\Filament\Resources\PortfolioCtaSettingResource;
use App\Models\PortfolioCtaSetting;
use Filament\Resources\Pages\ManageRecords;

class ManagePortfolioCtaSetting extends ManageRecords
{
    protected static string $resource = PortfolioCtaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $setting = PortfolioCtaSetting::first();

        if (!$setting) {
            // Create default CTA setting if none exists
            $setting = PortfolioCtaSetting::create([
                'title' => 'Siap Bergabung',
                'title_emphasis' => 'Bersama Mitra AROMAS?',
                'description' => 'Hubungi tim kami sekarang dan dapatkan penawaran harga khusus sesuai volume kebutuhan bisnis Anda.',
                'buttons' => [
                    ['label' => 'Chat via WhatsApp', 'url' => 'https://wa.me/6281234567890?text=Halo%20AROMAS,%20saya%20ingin%20menjadi%20mitra', 'icon' => 'bi-whatsapp', 'style' => 'white'],
                    ['label' => 'Kirim Pesan', 'url' => '/contact', 'icon' => 'bi-envelope-fill', 'style' => 'outline'],
                ],
                'is_active' => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $setting]));
    }
}
