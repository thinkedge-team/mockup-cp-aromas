<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutStorySettingResource\Pages;
use App\Models\AboutStorySetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\ImageUpload;

class AboutStorySettingResource extends Resource
{
    protected static ?string $model = AboutStorySetting::class;

    protected static ?string $navigationIcon = 'heroicon-s-book-open';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Our Story';

    protected static ?string $recordTitleAttribute = 'title_main';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Story Content')
                    ->description('Konten teks bagian Sejarah / Our Story')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Sejarah Kami'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('title_main')
                            ->label('Judul Utama')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Kisah di Balik Merek')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title_italic')
                            ->label('Nama Merek (Italic)')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('AROMAS')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('lead_paragraph')
                            ->label('Paragraf Lead')
                            ->required()
                            ->rows(3)
                            ->helperText('Kalimat pembuka, tampil lebih besar')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('body_paragraph_1')
                            ->label('Paragraf 1')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('body_paragraph_2')
                            ->label('Paragraf 2')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Gambar')
                    ->description('Foto perusahaan/pabrik yang tampil di sisi kanan')
                    ->schema([
                        ImageUpload::make('story_image')
                            ->label('Foto Story')
                            ->image()
                            ->directory('about/story')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('4:3')
                            ->helperText('Ukuran ideal: 800×600px atau rasio 4:3')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Badge pada Gambar')
                    ->description('Informasi yang tampil sebagai overlay di atas gambar')
                    ->schema([
                        Forms\Components\TextInput::make('founded_year')
                            ->label('Tahun Berdiri')
                            ->required()
                            ->numeric()
                            ->default(2009)
                            ->placeholder('2009'),
                        Forms\Components\TextInput::make('founded_label')
                            ->label('Label Tahun')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Tahun Berdiri AROMAS'),
                        Forms\Components\TextInput::make('cert_badge_text')
                            ->label('Badge Sertifikasi (bulat kanan atas)')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('ISO 22000'),
                    ])->columns(3),

                Forms\Components\Section::make('Pills / Label')
                    ->description('Label-label kecil yang tampil di bawah paragraf. Maksimal 4 item.')
                    ->schema([
                        Forms\Components\Repeater::make('pills')
                            ->label('Pills')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon')
                                    ->required()
                                    ->maxLength(50)
                                    ->placeholder('award-fill')
                                    ->helperText('Nama class Bootstrap Icon tanpa "bi-". Contoh: award-fill, patch-check-fill. Lihat semua icon di https://icons.getbootstrap.com'),
                                Forms\Components\TextInput::make('text')
                                    ->label('Teks')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Berdiri Tahun 2009'),
                            ])
                            ->columns(2)
                            ->maxItems(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                            ->columnSpanFull()
                            ->addActionLabel('Tambah Pill'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('story_image')
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('title_main')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('founded_year')
                    ->label('Tahun Berdiri'),
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
            'index' => Pages\ManageAboutStorySetting::route('/'),
            'edit'  => Pages\EditAboutStorySetting::route('/{record}/edit'),
        ];
    }
}
