<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipHeroSettingResource\Pages;
use App\Models\PartnershipHeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipHeroSettingResource extends Resource
{
    protected static ?string $model = PartnershipHeroSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $navigationGroup = 'Partnership';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Hero Setting';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Konten Hero')
                ->description('Bagian utama header halaman Kemitraan')
                ->icon('heroicon-o-megaphone')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('badge_text')
                        ->label('Badge Text')
                        ->helperText('Label kecil di atas judul, contoh: Program Kemitraan AROMAS')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('title_main')
                        ->label('Judul Utama')
                        ->helperText('Baris pertama judul hero')
                        ->required(),

                    Forms\Components\TextInput::make('title_italic')
                        ->label('Judul Italic (gradient)')
                        ->helperText('Baris kedua, tampil miring dengan efek gradient emas')
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('wa_number')
                        ->label('Nomor WhatsApp')
                        ->helperText('Format: 6281234567890 (tanpa + atau spasi)')
                        ->required(),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_main')->label('Judul'),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePartnershipHeroSetting::route('/'),
            'edit'  => Pages\EditPartnershipHeroSetting::route('/{record}/edit'),
        ];
    }
}
