<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutCoreValueResource\Pages;
use App\Models\AboutCoreValue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutCoreValueResource extends Resource
{
    protected static ?string $model = AboutCoreValue::class;

    protected static ?string $navigationIcon = 'heroicon-s-sparkles';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Core Values';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Core Value')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon Bootstrap')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('award')
                            ->helperText('Nama class Bootstrap Icon tanpa "bi-". Contoh: award, shield-check, lightbulb, tree. Lihat semua icon di https://icons.getbootstrap.com'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Nilai')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Kualitas')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAboutCoreValues::route('/'),
            'create' => Pages\CreateAboutCoreValue::route('/create'),
            'edit'   => Pages\EditAboutCoreValue::route('/{record}/edit'),
        ];
    }
}
