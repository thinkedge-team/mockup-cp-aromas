<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributorHeroSettingResource\Pages;
use App\Models\DistributorHeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DistributorHeroSettingResource extends Resource
{
    protected static ?string $model = DistributorHeroSetting::class;

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Distributor Page';
    protected static ?string $navigationLabel = 'Hero Setting';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Content')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_main')
                            ->label('Judul Utama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_italic')
                            ->label('Judul Italic (Gradient)')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Statistik')
                    ->schema([
                        Forms\Components\Repeater::make('stats')
                            ->label('Daftar Statistik')
                            ->schema([
                                Forms\Components\TextInput::make('value')->label('Nilai')->required(),
                                Forms\Components\TextInput::make('label')->label('Label')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_main')->label('Judul Utama'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Aktif'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Diperbarui'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistributorHeroSettings::route('/'),
            'create' => Pages\CreateDistributorHeroSetting::route('/create'),
            'edit' => Pages\EditDistributorHeroSetting::route('/{record}/edit'),
        ];
    }
}
