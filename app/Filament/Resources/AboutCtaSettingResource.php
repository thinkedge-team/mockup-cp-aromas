<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutCtaSettingResource\Pages;
use App\Models\AboutCtaSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutCtaSettingResource extends Resource
{
    protected static ?string $model = AboutCtaSetting::class;

    protected static ?string $navigationIcon = 'heroicon-s-cursor-arrow-rays';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'CTA Strip';

    protected static ?string $recordTitleAttribute = 'headline';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('CTA Strip')
                    ->description('Banner ajakan tindakan di bagian bawah halaman About Us')
                    ->schema([
                        Forms\Components\TextInput::make('headline')
                            ->label('Judul CTA')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Siap Bergabung Bersama Keluarga AROMAS?')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('subtext')
                            ->label('Teks Pendukung')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Tombol')
                    ->description('Atur teks, URL, dan ikon untuk tombol CTA. Ikon menggunakan Bootstrap Icons.')
                    ->schema([
                        Forms\Components\TextInput::make('button_1_text')
                            ->label('Tombol 1 — Teks')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Lihat Produk'),
                        Forms\Components\TextInput::make('button_1_url')
                            ->label('Tombol 1 — URL')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('/#products'),
                        Forms\Components\TextInput::make('button_1_icon')
                            ->label('Tombol 1 — Ikon')
                            ->placeholder('bi-bag-check-fill')
                            ->default('bi-bag-check-fill')
                            ->helperText('Masukkan nama icon dari Bootstrap Icons. Contoh: bi-bag-check-fill, bi-cart-fill')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('browse_icons_1')
                                    ->label('Browse')
                                    ->icon('heroicon-m-magnifying-glass')
                                    ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                                    ->color('primary')
                            ),
                        Forms\Components\TextInput::make('button_2_text')
                            ->label('Tombol 2 — Teks')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Hubungi Kami'),
                        Forms\Components\TextInput::make('button_2_url')
                            ->label('Tombol 2 — URL')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('/#contact'),
                        Forms\Components\TextInput::make('button_2_icon')
                            ->label('Tombol 2 — Ikon')
                            ->placeholder('bi-chat-dots-fill')
                            ->default('bi-chat-dots-fill')
                            ->helperText('Masukkan nama icon dari Bootstrap Icons. Contoh: bi-chat-dots-fill, bi-telephone-fill')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('browse_icons_2')
                                    ->label('Browse')
                                    ->icon('heroicon-m-magnifying-glass')
                                    ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                                    ->color('primary')
                            ),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('headline')
                    ->label('Judul CTA')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('button_1_text')
                    ->label('Tombol 1'),
                Tables\Columns\TextColumn::make('button_2_text')
                    ->label('Tombol 2'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAboutCtaSetting::route('/'),
            'edit'  => Pages\EditAboutCtaSetting::route('/{record}/edit'),
        ];
    }
}
