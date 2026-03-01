<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactHeroSettingResource\Pages;
use App\Models\ContactHeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactHeroSettingResource extends Resource
{
    protected static ?string $model = ContactHeroSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $navigationGroup = 'Hubungi Kami';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Hero Section';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero Utama')
                ->icon('heroicon-o-megaphone')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('badge_text')
                        ->label('Teks Badge')
                        ->placeholder('Kami Siap Membantu')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('title_line1')
                        ->label('Judul Baris 1')
                        ->placeholder('Hubungi Tim')
                        ->required(),

                    Forms\Components\TextInput::make('title_highlight')
                        ->label('Judul Highlight (Gradien Emas)')
                        ->placeholder('AROMAS')
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Chip Info (3 Pill Badge)')
                ->icon('heroicon-o-information-circle')
                ->description('3 chip kecil di bawah deskripsi hero. Icon: nama Bootstrap icon tanpa "bi-"')
                ->columns(3)
                ->schema([
                    // Chip 1
                    Forms\Components\TextInput::make('chip_1_icon')
                        ->label('Icon Chip 1')
                        ->placeholder('lightning-charge-fill')
                        ->helperText('Lihat: icons.getbootstrap.com'),
                    Forms\Components\TextInput::make('chip_1_text')
                        ->label('Teks Chip 1')
                        ->placeholder('Respon Cepat'),
                    Forms\Components\TextInput::make('chip_1_value')
                        ->label('Nilai Chip 1')
                        ->placeholder('≤ 2 Jam'),

                    // Chip 2
                    Forms\Components\TextInput::make('chip_2_icon')
                        ->label('Icon Chip 2')
                        ->placeholder('clock-fill'),
                    Forms\Components\TextInput::make('chip_2_text')
                        ->label('Teks Chip 2')
                        ->placeholder('Layanan'),
                    Forms\Components\TextInput::make('chip_2_value')
                        ->label('Nilai Chip 2')
                        ->placeholder('Sen–Jum, 08.00–17.00'),

                    // Chip 3
                    Forms\Components\TextInput::make('chip_3_icon')
                        ->label('Icon Chip 3')
                        ->placeholder('whatsapp'),
                    Forms\Components\TextInput::make('chip_3_text')
                        ->label('Teks Chip 3')
                        ->placeholder('WA 24 Jam'),
                    Forms\Components\TextInput::make('chip_3_value')
                        ->label('Nilai Chip 3')
                        ->placeholder('Khusus Order'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title_line1')->label('Judul'),
            Tables\Columns\TextColumn::make('badge_text')->label('Badge'),
            Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactHeroSettings::route('/'),
            'edit'  => Pages\EditContactHeroSetting::route('/{record}/edit'),
        ];
    }
}
