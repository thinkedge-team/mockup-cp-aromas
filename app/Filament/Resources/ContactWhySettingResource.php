<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactWhySettingResource\Pages;
use App\Models\ContactWhySetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactWhySettingResource extends Resource
{
    protected static ?string $model = ContactWhySetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Mengapa Kami';
    protected static ?string $navigationGroup = 'Hubungi Kami';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Mengapa Kami';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Box "Mengapa Hubungi Kami?"')
                ->description('Pengaturan untuk daftar alasan pada sidebar Mengapa Kami.')
                ->icon('heroicon-o-star')
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make('label')
                        ->label('Label Kecil (Atas)')
                        ->placeholder('Mengapa Hubungi Kami?')
                        ->required(),
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Utama')
                            ->placeholder('Kami Mitra Bisnis')
                            ->required(),
                        Forms\Components\TextInput::make('title_highlight')
                            ->label('Kata Highlight (Warna Emas)')
                            ->placeholder('Terpercaya'),
                    ])->columns(2),

                    Forms\Components\Repeater::make('why_items')
                        ->label('Daftar Alasan')
                        ->schema([
                            Forms\Components\TextInput::make('icon')
                                ->label('Icon Bootstrap')
                                ->placeholder('lightning-charge-fill')
                                ->helperText('Contoh: lightning-charge-fill (Tanpa awalan "bi-")'),
                            Forms\Components\Group::make([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul (Cetak Tebal)')
                                    ->placeholder('Respon Cepat'),
                                Forms\Components\TextInput::make('text')
                                    ->label('Deskripsi Detail')
                                    ->placeholder('rata-rata balasan dalam 2 jam kerja'),
                            ])->columns(2),
                        ])
                        ->addActionLabel('+ Tambah Alasan')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                ]),

            Forms\Components\Section::make('Jam Operasional (Sidebar)')
                ->description('Catatan waktu format dua kolom: "Label | Keterangan Waktu" (gunakan pemisah tanda titik dua ":")')
                ->icon('heroicon-o-clock')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('hours_weekday')
                        ->label('Baris Hari Kerja')
                        ->placeholder('Senin – Jumat : 08.00 – 17.00')
                        ->helperText('Contoh: Senin – Jumat : 08.00 – 17.00'),
                    Forms\Components\TextInput::make('hours_saturday')
                        ->label('Baris Hari Sabtu')
                        ->placeholder('Sabtu : 08.00 – 13.00')
                        ->helperText('Contoh: Sabtu : 08.00 – 13.00'),
                    Forms\Components\TextInput::make('hours_sunday')
                        ->label('Baris Minggu & Hari Libur')
                        ->placeholder('Minggu & Hari Libur : Tutup')
                        ->helperText('Contoh: Minggu & Hari Libur : Tutup'),
                    Forms\Components\TextInput::make('hours_wa_note')
                        ->label('Baris Catatan Spesial (WA)')
                        ->placeholder('WhatsApp Order : 24 Jam / 7 Hari')
                        ->helperText('Contoh: WhatsApp Order : 24 Jam / 7 Hari'),
                ]),

            Forms\Components\Section::make('Tautan Media Sosial')
                ->description('URL profil media sosial dan kontak cepat untuk digunakan pada tombol social box.')
                ->icon('heroicon-o-globe-alt')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('wa_url')
                        ->label('WhatsApp URL')
                        ->url()
                        ->placeholder('https://wa.me/6281234567890'),
                    Forms\Components\TextInput::make('email_address')
                        ->label('Alamat Email')
                        ->email()
                        ->placeholder('info@aromas.co.id'),
                    Forms\Components\TextInput::make('instagram_url')
                        ->label('Instagram URL')
                        ->url()
                        ->placeholder('https://instagram.com/aromas'),
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook URL')
                        ->url()
                        ->placeholder('https://facebook.com/aromas'),
                    Forms\Components\TextInput::make('youtube_url')
                        ->label('YouTube URL')
                        ->url()
                        ->placeholder('https://youtube.com/@aromas'),
                    Forms\Components\TextInput::make('tiktok_url')
                        ->label('TikTok URL')
                        ->url()
                        ->placeholder('https://tiktok.com/@aromas'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Judul'),
            Tables\Columns\TextColumn::make('wa_url')->label('WhatsApp URL')->limit(40),
            Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactWhySettings::route('/'),
            'edit'  => Pages\EditContactWhySetting::route('/{record}/edit'),
        ];
    }
}
