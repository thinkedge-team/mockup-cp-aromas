<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutVmSettingResource\Pages;
use App\Models\AboutVmSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutVmSettingResource extends Resource
{
    protected static ?string $model = AboutVmSetting::class;

    protected static ?string $navigationIcon = 'heroicon-s-eye';

    protected static ?string $navigationGroup = 'Tentang Kami';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Visi & Misi';

    protected static ?string $recordTitleAttribute = 'section_title_main';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Header Section')
                    ->schema([
                        Forms\Components\TextInput::make('section_title_main')
                            ->label('Judul Section')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Visi & Misi AROMAS'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\Textarea::make('section_subtitle')
                            ->label('Sub-judul / Deskripsi Section')
                            ->rows(2)
                            ->helperText('Kalimat singkat di bawah judul section')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Visi')
                    ->schema([
                        Forms\Components\Textarea::make('vision_text')
                            ->label('Teks Visi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Misi')
                    ->description('Daftar butir-butir misi. Bisa ditambah sebanyak yang diperlukan.')
                    ->schema([
                        Forms\Components\Repeater::make('mission_items')
                            ->label('Butir Misi')
                            ->schema([
                                Forms\Components\Textarea::make('text')
                                    ->label('Teks Misi')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => isset($state['text'])
                                ? \Illuminate\Support\Str::limit($state['text'], 60)
                                : null
                            )
                            ->columnSpanFull()
                            ->addActionLabel('Tambah Butir Misi'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title_main')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vision_text')
                    ->label('Visi')
                    ->limit(50),
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
            'index' => Pages\ManageAboutVmSetting::route('/'),
            'edit'  => Pages\EditAboutVmSetting::route('/{record}/edit'),
        ];
    }
}
