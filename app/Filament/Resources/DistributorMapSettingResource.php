<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributorMapSettingResource\Pages;
use App\Models\DistributorMapSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\ImageUpload;

class DistributorMapSettingResource extends Resource
{
    protected static ?string $model = DistributorMapSetting::class;

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Distributor Page';
    protected static ?string $navigationLabel = 'Map Setting';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Map Settings')
                    ->schema([
                        Forms\Components\TextInput::make('section_title')
                            ->label('Judul Bagian Peta')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('section_subtitle')
                            ->label('Sub-judul Bagian Peta')
                            ->maxLength(255),
                        ImageUpload::make('default_pin_image')
                            ->label('Default Pin Image')
                            ->image()
                            ->directory('map-pins')
                            ->helperText('Gambar pin marker default pada peta.'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')->label('Judul'),
                Tables\Columns\ImageColumn::make('default_pin_image')->label('Pin Default'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Aktif'),
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
            'index' => Pages\ListDistributorMapSettings::route('/'),
            'create' => Pages\CreateDistributorMapSetting::route('/create'),
            'edit' => Pages\EditDistributorMapSetting::route('/{record}/edit'),
        ];
    }
}
