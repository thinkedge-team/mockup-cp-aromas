<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributorCtaSettingResource\Pages;
use App\Models\DistributorCtaSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DistributorCtaSettingResource extends Resource
{
    protected static ?string $model = DistributorCtaSetting::class;

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationGroup = 'Distributor Page';
    protected static ?string $navigationLabel = 'CTA Setting';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Call to Action')
                    ->schema([
                        Forms\Components\TextInput::make('headline')
                            ->label('Headline')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('subtext')
                            ->label('Sub-text')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('button_url')
                            ->label('URL Tombol')
                            ->maxLength(255),
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
                Tables\Columns\TextColumn::make('headline')->label('Headline'),
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
            'index' => Pages\ListDistributorCtaSettings::route('/'),
            'create' => Pages\CreateDistributorCtaSetting::route('/create'),
            'edit' => Pages\EditDistributorCtaSetting::route('/{record}/edit'),
        ];
    }
}
