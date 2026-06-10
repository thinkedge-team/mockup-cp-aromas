<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchHeroSettingResource\Pages;
use App\Filament\Resources\BranchHeroSettingResource\RelationManagers;
use App\Models\BranchHeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchHeroSettingResource extends Resource
{
    protected static ?string $model = BranchHeroSetting::class;

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Cabang Page';
    protected static ?string $navigationLabel = 'Branch Hero Setting';
    protected static ?int $navigationSort = 7;

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
                            ->label('Daftar Statistik (Maksimal 3)')
                            ->schema([
                                Forms\Components\TextInput::make('value')->label('Nilai (Angka/Teks)')->required(),
                                Forms\Components\TextInput::make('label')->label('Label')->required(),
                            ])
                            ->columns(2)
                            ->maxItems(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_main')
                    ->label('Judul Utama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('badge_text')
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
            'index' => Pages\ListBranchHeroSettings::route('/'),
            'create' => Pages\CreateBranchHeroSetting::route('/create'),
            'edit' => Pages\EditBranchHeroSetting::route('/{record}/edit'),
        ];
    }
}
