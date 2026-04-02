<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipStatResource\Pages;
use App\Models\PartnershipStat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipStatResource extends Resource
{
    protected static ?string $model = PartnershipStat::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Statistik';
    protected static ?string $navigationGroup = 'Partnership';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Statistik Kemitraan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Angka Statistik')
                ->description('Ditampilkan sebagai strip angka di bawah hero. Maksimal 4 item.')
                ->icon('heroicon-o-chart-bar')
                ->schema([
                    Forms\Components\Repeater::make('stats')
                        ->label('Stats')
                        ->schema([
                            Forms\Components\Grid::make(3)->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Nilai')
                                    ->placeholder('500')
                                    ->required(),

                                Forms\Components\TextInput::make('suffix')
                                    ->label('Suffix')
                                    ->placeholder('+')
                                    ->helperText('Contoh: +, %, atau kosong'),

                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->placeholder('Mitra Aktif')
                                    ->required(),
                            ]),
                        ])
                        ->maxItems(4)
                        ->addActionLabel('+ Tambah Statistik')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => ($state['value'] ?? '') . ($state['suffix'] ?? '') . ' ' . ($state['label'] ?? '') ?: null),

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
                Tables\Columns\TextColumn::make('id')->label('#'),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePartnershipStat::route('/'),
            'edit'  => Pages\EditPartnershipStat::route('/{record}/edit'),
        ];
    }
}
