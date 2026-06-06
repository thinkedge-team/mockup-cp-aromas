<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributorResource\Pages;
use App\Models\Distributor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\ImageUpload;

class DistributorResource extends Resource
{
    protected static ?string $model = Distributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Distributor Page';
    protected static ?string $navigationLabel = 'Data Distributor';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Distributor')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Toko/Distributor')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor WhatsApp')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('province')
                            ->label('Provinsi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label('Kota')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Peta & Lokasi')
                    ->schema([
                        Forms\Components\TextInput::make('map_link')
                            ->label('Link Google Maps (Opsional)')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->step('0.00000001'),
                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->step('0.00000001'),
                        ImageUpload::make('custom_pin_image')
                            ->label('Custom Pin Image')
                            ->image()
                            ->directory('map-pins')
                            ->helperText('Gambar pin marker khusus. Jika kosong akan menggunakan pin default.')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('city')->label('Kota')->searchable(),
                Tables\Columns\TextColumn::make('province')->label('Provinsi')->searchable(),
                Tables\Columns\ImageColumn::make('custom_pin_image')->label('Pin'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistributors::route('/'),
            'create' => Pages\CreateDistributor::route('/create'),
            'edit' => Pages\EditDistributor::route('/{record}/edit'),
        ];
    }
}
