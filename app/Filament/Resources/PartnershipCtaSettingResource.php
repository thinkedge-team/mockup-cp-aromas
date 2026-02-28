<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipCtaSettingResource\Pages;
use App\Models\PartnershipCtaSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipCtaSettingResource extends Resource
{
    protected static ?string $model = PartnershipCtaSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'CTA Strip';
    protected static ?string $navigationGroup = 'Kemitraan';
    protected static ?int $navigationSort = 8;
    protected static ?string $modelLabel = 'CTA Strip';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Teks Utama')
                ->icon('heroicon-o-document-text')
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make('headline')
                        ->label('Headline')
                        ->placeholder('Siap Memulai Perjalanan Kemitraan Anda?')
                        ->required(),

                    Forms\Components\Textarea::make('subtext')
                        ->label('Sub-teks')
                        ->rows(2),
                ]),

            Forms\Components\Section::make('Tombol 1 — WhatsApp')
                ->description('Tombol utama berwarna hijau WA')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('button_1_text')
                        ->label('Label Tombol')
                        ->placeholder('Mulai Konsultasi')
                        ->required(),

                    Forms\Components\TextInput::make('wa_number')
                        ->label('Nomor WhatsApp')
                        ->helperText('Format: 6281234567890 (tanpa +)')
                        ->required(),

                    Forms\Components\TextInput::make('wa_message')
                        ->label('Pre-fill Pesan WA')
                        ->placeholder('Halo AROMAS, saya ingin bergabung sebagai mitra')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Tombol 2 — Formulir')
                ->description('Tombol outline menuju halaman kontak/formulir')
                ->icon('heroicon-o-document-text')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('button_2_text')
                        ->label('Label Tombol')
                        ->placeholder('Kirim Formulir')
                        ->required(),

                    Forms\Components\TextInput::make('button_2_url')
                        ->label('URL Halaman')
                        ->placeholder('/contact')
                        ->required(),
                ]),

            Forms\Components\Section::make('Status')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('CTA Aktif')
                        ->default(true)
                        ->inline(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('headline')->label('Headline'),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePartnershipCtaSetting::route('/'),
            'edit'  => Pages\EditPartnershipCtaSetting::route('/{record}/edit'),
        ];
    }
}
