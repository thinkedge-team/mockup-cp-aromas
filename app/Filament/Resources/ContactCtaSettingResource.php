<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactCtaSettingResource\Pages;
use App\Models\ContactCtaSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactCtaSettingResource extends Resource
{
    protected static ?string $model = ContactCtaSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';
    protected static ?string $navigationLabel = 'CTA Strip';
    protected static ?string $navigationGroup = 'Hubungi Kami';
    protected static ?int $navigationSort = 6;
    protected static ?string $modelLabel = 'CTA Strip';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Teks CTA Strip')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->placeholder('Masih Punya Pertanyaan?')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(2)
                        ->placeholder('Tim AROMAS siap membantu Anda 24 jam via WhatsApp...'),
                ]),

            Forms\Components\Section::make('Tombol Aksi')
                ->icon('heroicon-o-link')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('btn_wa_label')
                        ->label('Label Tombol WhatsApp')
                        ->placeholder('Chat WhatsApp'),
                    Forms\Components\TextInput::make('btn_wa_number')
                        ->label('Nomor WhatsApp (wa.me link)')
                        ->placeholder('6281234567890')
                        ->helperText('Format: 62xxx tanpa +, spasi, atau tanda kurung'),
                    Forms\Components\TextInput::make('btn_wa_message')
                        ->label('Pre-fill Pesan WhatsApp')
                        ->placeholder('Halo AROMAS, saya ingin bertanya')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('btn_phone_label')
                        ->label('Label Tombol Telepon')
                        ->placeholder('Telepon Kami'),
                    Forms\Components\TextInput::make('btn_phone_number')
                        ->label('Nomor Telepon (tel: link)')
                        ->placeholder('02112345678')
                        ->helperText('Format: tanpa tanda + atau spasi'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Judul'),
            Tables\Columns\TextColumn::make('btn_wa_number')->label('Nomor WA'),
            Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactCtaSettings::route('/'),
            'edit'  => Pages\EditContactCtaSetting::route('/{record}/edit'),
        ];
    }
}
