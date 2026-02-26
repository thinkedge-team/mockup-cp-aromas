<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Filament\Resources\HeroSlideResource\RelationManagers;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static ?string $navigationIcon = 'heroicon-s-film';

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Hero Slider';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->default(true),
                        Forms\Components\FileUpload::make('background_image')
                            ->image()
                            ->directory('hero-slides/backgrounds'),
                        Forms\Components\FileUpload::make('product_image')
                            ->image()
                            ->directory('hero-slides/products')
                            ->helperText('Main product image shown on the right side'),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Hero Content')
                    ->schema([
                        Forms\Components\TextInput::make('badge_icon')
                            ->required()
                            ->placeholder('bi-award-fill'),
                        Forms\Components\TextInput::make('badge_text')
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\TextInput::make('title_gradient')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Pills (Features)')
                    ->schema([
                        Forms\Components\Repeater::make('pills')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Pill Text')
                                    ->required()
                                    ->maxLength(50),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Buttons')
                    ->schema([
                        Forms\Components\TextInput::make('primary_button_text')
                            ->required(),
                        Forms\Components\TextInput::make('primary_button_url')
                            ->required(),
                        Forms\Components\TextInput::make('secondary_button_text')
                            ->required(),
                        Forms\Components\TextInput::make('secondary_button_url')
                            ->required(),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Trust Items')
                    ->description('Statistics shown below buttons (e.g., 15+ Years Experience)')
                    ->schema([
                        Forms\Components\Repeater::make('trust_items')
                            ->schema([
                                Forms\Components\TextInput::make('number')
                                    ->label('Number')
                                    ->required()
                                    ->placeholder('15+')
                                    ->maxLength(20),
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->placeholder('Tahun Pengalaman')
                                    ->maxLength(100),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['number'] ?? '') . ' - ' . ($state['label'] ?? ''))
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Floating Cards')
                    ->description('Cards floating around product image')
                    ->schema([
                        Forms\Components\Repeater::make('floating_cards')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Bootstrap Icon')
                                    ->required()
                                    ->placeholder('bi-heart-pulse-fill')
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('subtitle')
                                    ->label('Subtitle')
                                    ->required()
                                    ->maxLength(50),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['title'] ?? '') . ' - ' . ($state['subtitle'] ?? ''))
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('badge_icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('badge_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title_gradient')
                    ->searchable(),
                Tables\Columns\TextColumn::make('primary_button_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('primary_button_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('secondary_button_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('secondary_button_url')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('background_image'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit' => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
