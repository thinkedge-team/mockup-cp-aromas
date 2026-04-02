<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipAdvantageResource\Pages;
use App\Models\PartnershipAdvantage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipAdvantageResource extends Resource
{
    protected static ?string $model = PartnershipAdvantage::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Keunggulan Kami';
    protected static ?string $navigationGroup = 'Partnership';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Keunggulan';
    protected static ?string $pluralModelLabel = 'Keunggulan Kami';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Keunggulan')
                ->icon('heroicon-o-shield-check')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label('Icon Bootstrap')
                        ->helperText('Tanpa "bi-", contoh: award-fill. Lihat: https://icons.getbootstrap.com')
                        ->placeholder('award-fill')
                        ->required(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->placeholder('Produk Bersertifikat')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->placeholder('Halal MUI, BPOM, SNI, dan ISO 22000 — standar kualitas internasional.')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false),
                ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPartnershipAdvantages::route('/'),
            'create' => Pages\CreatePartnershipAdvantage::route('/create'),
            'edit'   => Pages\EditPartnershipAdvantage::route('/{record}/edit'),
        ];
    }
}
