<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImpactStatResource\Pages;
use App\Filament\Resources\ImpactStatResource\RelationManagers;
use App\Models\ImpactStat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\ImageUpload;

class ImpactStatResource extends Resource
{
    protected static ?string $model = ImpactStat::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-bar';

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Impact Stats';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Impact Stat')
                    ->description('Configure statistics for the impact section')
                    ->schema([
                        ImageUpload::make('image')
                            ->label('Background Image')
                            ->image()
                            ->directory('impact-stats')
                            ->helperText('Background image for the stat card'),
                        Forms\Components\TextInput::make('number')
                            ->label('Impact Value')
                            ->required()
                            ->placeholder('e.g., 15+, 500+, 1M+')
                            ->maxLength(20)
                            ->helperText('The statistic value (e.g., 15+, 500+)'),
                        Forms\Components\TextInput::make('label')
                            ->label('Label')
                            ->required()
                            ->placeholder('e.g., Tahun Pengalaman')
                            ->maxLength(100)
                            ->helperText('Description of the statistic'),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImpactStats::route('/'),
            'create' => Pages\CreateImpactStat::route('/create'),
            'edit' => Pages\EditImpactStat::route('/{record}/edit'),
        ];
    }
}
