<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutMilestoneResource\Pages;
use App\Models\AboutMilestone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutMilestoneResource extends Resource
{
    protected static ?string $model = AboutMilestone::class;

    protected static ?string $navigationIcon = 'heroicon-s-map-pin';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Milestones / Timeline';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Milestone')
                    ->schema([
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun')
                            ->required()
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(2100)
                            ->placeholder('2009'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Bila kosong, urutan default berdasarkan tahun'),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon Bootstrap')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('flag-fill')
                            ->helperText('Nama class Bootstrap Icon tanpa "bi-". Contoh: flag-fill, patch-check-fill, geo-alt-fill. Lihat di https://icons.getbootstrap.com'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Milestone')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
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
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
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
            'index'  => Pages\ListAboutMilestones::route('/'),
            'create' => Pages\CreateAboutMilestone::route('/create'),
            'edit'   => Pages\EditAboutMilestone::route('/{record}/edit'),
        ];
    }
}
