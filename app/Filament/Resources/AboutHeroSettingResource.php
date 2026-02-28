<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutHeroSettingResource\Pages;
use App\Models\AboutHeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutHeroSettingResource extends Resource
{
    protected static ?string $model = AboutHeroSetting::class;

    protected static ?string $navigationIcon = 'heroicon-s-home';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Hero Section';

    protected static ?string $recordTitleAttribute = 'title_main';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Content')
                    ->description('Konten utama bagian hero halaman About Us')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Perjalanan Kami')
                            ->helperText('Teks kecil di atas judul utama'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('title_main')
                            ->label('Judul Utama')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Menghadirkan Kualitas')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title_italic')
                            ->label('Judul Italic (gradient)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Terbaik Untuk Indonesia')
                            ->helperText('Bagian judul yang tampil miring dengan efek gradient')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Statistik Hero')
                    ->description('Angka-angka statistik yang tampil di bawah deskripsi. Maksimal 4 item.')
                    ->schema([
                        Forms\Components\Repeater::make('stats')
                            ->label('Statistik')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Nilai')
                                    ->required()
                                    ->maxLength(20)
                                    ->placeholder('15+'),
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Tahun Berdiri'),
                            ])
                            ->columns(2)
                            ->maxItems(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['value'] ?? '') . ' — ' . ($state['label'] ?? ''))
                            ->columnSpanFull()
                            ->addActionLabel('Tambah Statistik'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_main')
                    ->label('Judul Utama')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('badge_text')
                    ->label('Badge'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAboutHeroSetting::route('/'),
            'edit'  => Pages\EditAboutHeroSetting::route('/{record}/edit'),
        ];
    }
}
