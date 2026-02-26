<?php

namespace App\Filament\Resources\FooterSettingResource\Pages;

use App\Filament\Resources\FooterSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditFooterSetting extends EditRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure default values for JSON fields
        $data['contact_info'] = $data['contact_info'] ?? [
            'phone' => '',
            'email' => '',
            'address' => '',
            'whatsapp' => '',
        ];
        
        $data['social_links'] = $data['social_links'] ?? [
            'instagram' => '',
            'facebook' => '',
            'tiktok' => '',
            'youtube' => '',
        ];
        
        $data['legal_links'] = $data['legal_links'] ?? [
            'privacy' => '/privacy',
            'terms' => '/terms',
        ];

        return $data;
    }
}
