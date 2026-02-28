<?php

namespace App\Filament\Resources\AboutStorySettingResource\Pages;

use App\Filament\Resources\AboutStorySettingResource;
use App\Models\AboutStorySetting;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutStorySetting extends ManageRecords
{
    protected static string $resource = AboutStorySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = AboutStorySetting::first();

        if (!$record) {
            $record = AboutStorySetting::create([
                'badge_text'       => 'Sejarah Kami',
                'title_main'       => 'Kisah di Balik Merek',
                'title_italic'     => 'AROMAS',
                'lead_paragraph'   => 'Berawal dari sebuah pabrik kecil di Jakarta pada tahun 2009, AROMAS tumbuh menjadi salah satu produsen minyak goreng sawit terpercaya di Indonesia.',
                'body_paragraph_1' => 'Dengan visi yang kuat untuk menghadirkan produk berkualitas tinggi yang dapat dinikmati setiap keluarga, kami terus berinovasi dalam proses produksi.',
                'founded_year'     => 2009,
                'founded_label'    => 'Tahun Berdiri AROMAS',
                'cert_badge_text'  => 'ISO 22000',
                'pills'            => [
                    ['icon' => 'award-fill', 'text' => 'Berdiri Tahun 2009'],
                    ['icon' => 'patch-check-fill', 'text' => 'Bersertifikat Halal MUI'],
                ],
                'is_active' => true,
            ]);
        }

        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
