<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CapacityStatResource\Pages;
use App\Filament\Resources\CapacityStatResource\RelationManagers;
use App\Models\CapacityStat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CapacityStatResource extends Resource
{
    protected static ?string $model = CapacityStat::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Our Machine';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Capacity Stats';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Capacity Stat')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->required()
                            ->placeholder('bi-wind')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('number')
                            ->required()
                            ->placeholder('6.000')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCapacityStats::route('/'),
            'create' => Pages\CreateCapacityStat::route('/create'),
            'edit' => Pages\EditCapacityStat::route('/{record}/edit'),
        ];
    }
}
