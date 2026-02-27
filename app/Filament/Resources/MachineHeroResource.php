<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MachineHeroResource\Pages;
use App\Models\MachineHero;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MachineHeroResource extends Resource
{
    protected static ?string $model = MachineHero::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Our Machine';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Machine Hero';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Section')
                    ->description('Configure the hero section at top of Our Machine page')
                    ->schema([
                        Forms\Components\TextInput::make('badge_icon')
                            ->label('Badge Icon')
                            ->placeholder('bi-gear-wide-connected')
                            ->default('bi-gear-wide-connected')
                            ->maxLength(50)
                            ->helperText('Bootstrap icon class'),
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->default('Fasilitas Produksi')
                            ->maxLength(100),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Textarea::make('title')
                                    ->label('Title (First Part)')
                                    ->required()
                                    ->rows(2)
                                    ->placeholder('Mesin Berteknologi Tinggi,')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('title_gradient')
                                    ->label('Title (Gradient Text)')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Kualitas Tanpa Kompromi'),
                            ])->columns(2),
                        Forms\Components\FileUpload::make('production_line_image')
                            ->label('Production Line Image')
                            ->image()
                            ->required()
                            ->directory('machines/hero')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(1),

                Forms\Components\Section::make('Hero Stats')
                    ->description('Statistics shown below production line image')
                    ->schema([
                        Forms\Components\Repeater::make('hero_stats')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon Class')
                                    ->placeholder('bi-lightning-charge-fill')
                                    ->default('bi-lightning-charge-fill')
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('number')
                                    ->label('Number')
                                    ->required()
                                    ->placeholder('6.000 BPH')
                                    ->maxLength(50)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->placeholder('Kapasitas Blowing')
                                    ->maxLength(100)
                                    ->columnSpan(2),
                            ])->columns(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['number'] ?? '') . ' - ' . ($state['label'] ?? ''))
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('badge_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('production_line_image')
                    ->label('Image'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->filters([])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMachineHero::route('/'),
            'create' => Pages\CreateMachineHero::route('/create'),
            'edit' => Pages\EditMachineHero::route('/{record}/edit'),
        ];
    }
}
