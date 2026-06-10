<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchSectionSettingResource\Pages;
use App\Filament\Resources\BranchSectionSettingResource\RelationManagers;
use App\Models\BranchSectionSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchSectionSettingResource extends Resource
{
    protected static ?string $model = BranchSectionSetting::class;

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Cabang Page';
    protected static ?string $navigationLabel = 'Branch Section Setting';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Map Section')
                    ->schema([
                        Forms\Components\TextInput::make('map_title')
                            ->label('Map Title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('map_description')
                            ->label('Map Description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Branch List Section')
                    ->schema([
                        Forms\Components\TextInput::make('list_label')
                            ->label('List Label (Kecil di atas judul)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('list_title')
                            ->label('List Title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('list_description')
                            ->label('List Description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('map_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('list_title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListBranchSectionSettings::route('/'),
            'create' => Pages\CreateBranchSectionSetting::route('/create'),
            'edit' => Pages\EditBranchSectionSetting::route('/{record}/edit'),
        ];
    }
}
