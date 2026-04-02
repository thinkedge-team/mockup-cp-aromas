<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoSettingResource\Pages;
use App\Models\ContactInfoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactInfoSettingResource extends Resource
{
    protected static ?string $model = ContactInfoSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Info Kontak';
    protected static ?string $navigationGroup = 'Kontak';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Info Kontak';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('📍 Kartu Alamat')
                ->description('Pengaturan untuk kartu informasi alamat kantor pusat.')
                ->icon('heroicon-o-map-pin')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('address_title')
                        ->label('Judul Kartu')
                        ->placeholder('Kantor Pusat')
                        ->required(),
                    Forms\Components\TextInput::make('address_action_label')
                        ->label('Label Tombol Aksi')
                        ->placeholder('Lihat di Maps'),
                    Forms\Components\Textarea::make('address_text')
                        ->label('Detail Alamat')
                        ->rows(3)
                        ->placeholder("Jl. Industri Raya No. 123\nKawasan Industri, Jakarta 12345\nDKI Jakarta, Indonesia")
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('address_maps_url')
                        ->label('URL Google Maps')
                        ->url()
                        ->placeholder('https://maps.google.com/?q=...')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('📞 Kartu Telepon & Email')
                ->description('Pengaturan kontak telepon kantor, fax, dan alamat email.')
                ->icon('heroicon-o-phone')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('phone_title')
                        ->label('Judul Kartu')
                        ->placeholder('Telepon & Fax')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('hours_weekday_label')
                            ->label('Label Kontak 1')
                            ->placeholder('Kantor'),
                        Forms\Components\TextInput::make('phone_office')
                            ->label('Nomor Kontak 1 (Tampil)')
                            ->placeholder('(021) 1234-5678'),
                    ])->columns(2)->columnSpanFull(),

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('hours_saturday_label')
                            ->label('Label Kontak 2')
                            ->placeholder('Fax'),
                        Forms\Components\TextInput::make('phone_fax')
                            ->label('Nomor Kontak 2 (Tampil)')
                            ->placeholder('(021) 1234-5679'),
                    ])->columns(2)->columnSpanFull(),

                    Forms\Components\TextInput::make('phone_email')
                        ->label('Alamat Email')
                        ->email()
                        ->placeholder('info@aromas.co.id')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('phone_number')
                        ->label('No. Telepon (URL Panggilan)')
                        ->placeholder('02112345678')
                        ->helperText('Dipakai untuk aksi tombol. Format angka tanpa spasi/tanda hubung.'),
                    Forms\Components\TextInput::make('phone_action_label')
                        ->label('Label Tombol Aksi')
                        ->placeholder('Hubungi Sekarang'),
                ]),

            Forms\Components\Section::make('💬 Kartu WhatsApp')
                ->description('Pengaturan nomor WhatsApp untuk sales dan distribusi.')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('wa_title')
                        ->label('Judul Kartu')
                        ->placeholder('WhatsApp')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('wa_sales_label')
                            ->label('Label WA 1')
                            ->placeholder('Sales'),
                        Forms\Components\TextInput::make('wa_sales_display')
                            ->label('Nomor WA 1 (Tampil)')
                            ->placeholder('+62 812-3456-7890'),
                    ])->columns(2)->columnSpanFull(),

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('wa_dist_label')
                            ->label('Label WA 2')
                            ->placeholder('Distribusi'),
                        Forms\Components\TextInput::make('wa_dist_display')
                            ->label('Nomor WA 2 (Tampil)')
                            ->placeholder('+62 811-2345-6789'),
                    ])->columns(2)->columnSpanFull(),

                    Forms\Components\TextInput::make('wa_note')
                        ->label('Catatan Tambahan')
                        ->placeholder('● Aktif 24 jam untuk order')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('wa_sales_number')
                        ->label('No. WhatsApp Utama (URL Chat)')
                        ->placeholder('6281234567890')
                        ->helperText('Dipakai untuk aksi tombol. Gunakan kode negara 62 tanpa + atau spasi.'),
                    Forms\Components\TextInput::make('wa_action_label')
                        ->label('Label Tombol Aksi')
                        ->placeholder('Chat Sekarang'),
                ]),

            Forms\Components\Section::make('🕐 Kartu Jam Operasional')
                ->description('Pengaturan informasi waktu operasional perusahaan.')
                ->icon('heroicon-o-clock')
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make('hours_title')
                        ->label('Judul Kartu')
                        ->placeholder('Jam Operasional')
                        ->required(),
                    Forms\Components\TextInput::make('hours_weekday_value')
                        ->label('Waktu Hari Kerja')
                        ->placeholder('Sen – Jum: 08.00 – 17.00'),
                    Forms\Components\TextInput::make('hours_saturday_value')
                        ->label('Waktu Hari Sabtu')
                        ->placeholder('Sabtu: 08.00 – 13.00'),
                    Forms\Components\TextInput::make('hours_sunday_value')
                        ->label('Waktu Hari Minggu / Libur')
                        ->placeholder('Minggu: Tutup'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('address_title')->label('Judul Alamat'),
            Tables\Columns\TextColumn::make('phone_email')->label('Email Kontak'),
            Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactInfoSettings::route('/'),
            'edit'  => Pages\EditContactInfoSetting::route('/{record}/edit'),
        ];
    }
}
