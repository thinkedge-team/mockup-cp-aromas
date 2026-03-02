<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioPartnerResource\Pages;
use App\Models\PortfolioPartner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioPartnerResource extends Resource
{
    protected static ?string $model = PortfolioPartner::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Portfolio & Kemitraan';

    protected static ?string $navigationLabel = 'Mitra Partner';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Partner Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Str::slug($state)))
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->options([
                                'retail' => 'Retail',
                                'horeca' => 'Horeca (Hotel & Resto)',
                                'industri' => 'Industri',
                                'catering' => 'Catering',
                            ])
                            ->required()
                            ->default('retail')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('subcategory')
                            ->label('Subcategory')
                            ->placeholder('e.g., Minimarket, Hotel ★★★★★, Food Court')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('tagline')
                            ->label('Tagline')
                            ->placeholder('Short description under name')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Full Description (for modal)')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Image & Details')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Partner Image')
                            ->image()
                            ->directory('portfolio/partners')
                            ->maxSize(5120)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('location')
                            ->label('Location')
                            ->placeholder('e.g., 50+ Cabang Jabodetabek')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('products')
                            ->label('Products')
                            ->placeholder('e.g., Botol 1L, 2L & Jeriken 5L')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('partnership_since')
                            ->label('Partnership Since')
                            ->placeholder('e.g., 2021')
                            ->maxLength(50)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('volume')
                            ->label('Volume')
                            ->placeholder('e.g., > 10.000 L/bulan')
                            ->maxLength(100)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('rating')
                            ->label('Rating')
                            ->numeric()
                            ->default(5.0)
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.1)
                            ->columnSpan(1),
                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Add tags...')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first')
                            ->columnSpan(1),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subcategory')
                    ->label('Subcategory')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'retail' => 'Retail',
                        'horeca' => 'Horeca',
                        'industri' => 'Industri',
                        'catering' => 'Catering',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ReplicateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioPartners::route('/'),
            'create' => Pages\CreatePortfolioPartner::route('/create'),
            'edit' => Pages\EditPortfolioPartner::route('/{record}/edit'),
        ];
    }
}
