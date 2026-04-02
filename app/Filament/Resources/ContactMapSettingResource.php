<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMapSettingResource\Pages;
use App\Models\ContactMapSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMapSettingResource extends Resource
{
    protected static ?string $model = ContactMapSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Peta & Lokasi';
    protected static ?string $navigationGroup = 'Kontak';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Peta & Lokasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Header Section Peta')
                ->icon('heroicon-o-map')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('section_label')
                        ->label('Label Kecil')
                        ->placeholder('Lokasi Kami'),
                    Forms\Components\TextInput::make('branch_section_title')
                        ->label('Judul Section Cabang')
                        ->placeholder('Cabang & Outlet Kami'),
                    Forms\Components\TextInput::make('section_title')
                        ->label('Judul Section')
                        ->placeholder('Temukan Kantor & Cabang AROMAS')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('section_desc')
                        ->label('Deskripsi Section')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Embed Google Maps')
                ->icon('heroicon-o-globe-alt')
                ->description('Salin URL dari tombol "Bagikan" → "Sematkan Peta" di Google Maps, lalu ambil nilai src="..." dari iframe')
                ->schema([
                    Forms\Components\Textarea::make('map_embed_url')
                        ->label('URL Embed Iframe Google Maps')
                        ->rows(4)
                        ->placeholder('https://www.google.com/maps/embed?pb=...')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Overlay Card di Atas Peta')
                ->icon('heroicon-o-building-office')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('map_card_title')
                        ->label('Judul Overlay')
                        ->placeholder('AROMAS Kantor Pusat'),
                    Forms\Components\TextInput::make('map_card_direction_url')
                        ->label('URL Petunjuk Arah')
                        ->url()
                        ->placeholder('https://maps.google.com/?q=...'),
                    Forms\Components\TextInput::make('map_card_address')
                        ->label('Alamat di Overlay')
                        ->placeholder('Jl. Industri Raya No. 123, Jakarta 12345')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Info Data Cabang')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    Forms\Components\Placeholder::make('branch_info')
                        ->label('')
                        ->content('Data kartu cabang/outlet di bawah peta dikelola dari menu Beranda → Cabang. Perubahan di sana akan otomatis tampil di halaman ini dan di Beranda.'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('section_title')->label('Judul Section'),
            Tables\Columns\TextColumn::make('map_card_title')->label('Judul Overlay'),
            Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactMapSettings::route('/'),
            'edit'  => Pages\EditContactMapSetting::route('/{record}/edit'),
        ];
    }
}
