<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipCompareSettingResource\Pages;
use App\Models\PartnershipCompareSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipCompareSettingResource extends Resource
{
    protected static ?string $model = PartnershipCompareSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Tabel Perbandingan';
    protected static ?string $navigationGroup = 'Kemitraan';
    protected static ?int $navigationSort = 6;
    protected static ?string $modelLabel = 'Tabel Perbandingan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Header Seksi')
                ->icon('heroicon-o-information-circle')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('section_title')
                        ->label('Judul Seksi')
                        ->required(),

                    Forms\Components\Textarea::make('section_subtitle')
                        ->label('Subjudul')
                        ->rows(2),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false),
                ]),

            Forms\Components\Section::make('Baris Perbandingan')
                ->description('Setiap baris adalah satu fitur yang dibandingkan. Nilai: teks bebas, "yes", "no", atau "partial" (akan dirender sebagai ikon ✓/✗/–)')
                ->icon('heroicon-o-table-cells')
                ->schema([
                    Forms\Components\Repeater::make('rows')
                        ->label(false)
                        ->schema([
                            Forms\Components\TextInput::make('feature')
                                ->label('Nama Fitur')
                                ->placeholder('Modal Awal')
                                ->required()
                                ->columnSpanFull(),

                            Forms\Components\Grid::make(5)->schema([
                                Forms\Components\TextInput::make('franchise_val')
                                    ->label('🏅 Franchise')
                                    ->placeholder('Rp 50–150 Jt'),

                                Forms\Components\TextInput::make('distributor_val')
                                    ->label('🚚 Distributor')
                                    ->placeholder('yes / no / partial / teks'),

                                Forms\Components\TextInput::make('agen_val')
                                    ->label('🏪 Agen/Reseller')
                                    ->placeholder('yes'),

                                Forms\Components\TextInput::make('maklon_val')
                                    ->label('⚙️ Maklon')
                                    ->placeholder('no'),

                                Forms\Components\TextInput::make('implan_val')
                                    ->label('🏢 Implan')
                                    ->placeholder('partial'),
                            ]),
                        ])
                        ->addActionLabel('+ Tambah Baris')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['feature'] ?? null),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')->label('Judul'),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePartnershipCompareSetting::route('/'),
            'edit'  => Pages\EditPartnershipCompareSetting::route('/{record}/edit'),
        ];
    }
}
