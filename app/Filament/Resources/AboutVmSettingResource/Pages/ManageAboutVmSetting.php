<?php

namespace App\Filament\Resources\AboutVmSettingResource\Pages;

use App\Filament\Resources\AboutVmSettingResource;
use App\Models\AboutVmSetting;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutVmSetting extends ManageRecords
{
    protected static string $resource = AboutVmSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = AboutVmSetting::first();

        if (!$record) {
            $record = AboutVmSetting::create([
                'section_title_main' => 'Visi & Misi AROMAS',
                'section_subtitle'   => 'Prinsip yang mengarahkan setiap langkah dan keputusan kami.',
                'vision_text'        => 'Menjadi produsen minyak goreng terkemuka yang dipercaya oleh setiap keluarga Indonesia.',
                'mission_items'      => [
                    ['text' => 'Memproduksi minyak goreng berkualitas tinggi dengan standar keamanan pangan internasional.'],
                    ['text' => 'Mengedepankan inovasi teknologi untuk proses produksi yang ramah lingkungan.'],
                ],
                'is_active' => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
