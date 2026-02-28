<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutCertificationResource\Pages;
use App\Models\AboutCertification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutCertificationResource extends Resource
{
    protected static ?string $model = AboutCertification::class;

    protected static ?string $navigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Penghargaan & Sertifikasi';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Penghargaan / Sertifikasi')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon Bootstrap')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('moon-stars-fill')
                            ->helperText('Nama class Bootstrap Icon tanpa "bi-". Contoh: moon-stars-fill, shield-check, globe, trophy-fill. Lihat di https://icons.getbootstrap.com'),
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun Diperoleh')
                            ->required()
                            ->numeric()
                            ->placeholder('2013'),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Penghargaan/Sertifikasi')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Halal MUI')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('issuer')
                            ->label('Penerbit / Organisasi')
                            ->required()
                            ->maxLength(200)
                            ->placeholder('Majelis Ulama Indonesia')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
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
                    ->label('Icon')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('issuer')
                    ->label('Penerbit')
                    ->limit(40)
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
            ])
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
            'index'  => Pages\ListAboutCertifications::route('/'),
            'create' => Pages\CreateAboutCertification::route('/create'),
            'edit'   => Pages\EditAboutCertification::route('/{record}/edit'),
        ];
    }
}
