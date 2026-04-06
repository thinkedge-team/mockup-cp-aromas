<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\BrandCategory;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    protected static ?string $navigationGroup = 'Produk';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Brand & Category')
                    ->description('Select brand first, then category will be filtered based on available brand-category combinations')
                    ->schema([
                        Forms\Components\Select::make('brand_id')
                            ->label('Brand')
                            ->options(ProductBrand::orderBy('order')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('category_id', null);
                            })
                            ->helperText('Select brand first'),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(function (Get $get): Collection {
                                $brandId = $get('brand_id');
                                if (!$brandId) {
                                    return collect();
                                }

                                // Get categories that are linked to this brand via brand_category pivot
                                return ProductCategory::whereHas('brandCategories', function ($q) use ($brandId) {
                                    $q->where('brand_id', $brandId)
                                      ->where('is_active', true);
                                })
                                ->where('is_active', true)
                                ->orderBy('order')
                                ->pluck('title', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabled(fn (Get $get): bool => !$get('brand_id'))
                            ->helperText(fn (Get $get): string => 
                                $get('brand_id') 
                                    ? 'Select category for this brand' 
                                    : 'Please select a brand first'
                            ),
                    ])->columns(2),

                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tagline')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('badge_text')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Product Images')
                    ->description('Product images - first image with "Set as Banner" will be shown on card')
                    ->schema([
                        Forms\Components\Repeater::make('images')
                            ->schema([
                                Forms\Components\FileUpload::make('url')
                                    ->label('Image')
                                    ->image()
                                    ->directory('products')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('order')
                                    ->label('Display Order')
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                                Forms\Components\Toggle::make('is_banner')
                                    ->label('Set as Banner')
                                    ->default(false)
                                    ->helperText('First image with this enabled will be shown on product card')
                                    ->columnSpan(1),
                            ])->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['is_banner'] ? '🏷️ Banner Image' : '📷 Gallery Image')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Product Sizes')
                    ->description('Available sizes for this product')
                    ->schema([
                        Forms\Components\Repeater::make('sizes')
                            ->schema([
                                Forms\Components\TextInput::make('volume')
                                    ->label('Volume')
                                    ->required()
                                    ->numeric()
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->placeholder('ml, liter')
                                    ->columnSpan(1),
                                Forms\Components\Toggle::make('is_popular')
                                    ->label('Popular')
                                    ->default(false)
                                    ->columnSpan(1),
                            ])->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['volume'] ?? '') . ' ' . ($state['unit'] ?? ''))
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Product Features')
                    ->description('Features shown on product card')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon Class')
                                    ->placeholder('bi-check-circle-fill')
                                    ->default('bi-check-circle-fill')
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('text')
                                    ->label('Feature Text')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                            ])->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Modal Content')
                    ->description('Content shown in product detail modal')
                    ->schema([
                        Forms\Components\TextInput::make('modal_title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('modal_subtitle')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Repeater::make('modal_details')
                            ->label('Modal Details')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('value')
                                    ->label('Value')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(1),
                            ])->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['label'] ?? '') . ': ' . ($state['value'] ?? ''))
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('modal_features')
                            ->label('Modal Features')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon Class')
                                    ->placeholder('bi-check-circle-fill')
                                    ->default('bi-check-circle-fill')
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('text')
                                    ->label('Feature Text')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                            ])->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('whatsapp_message')
                            ->label('WhatsApp Message')
                            ->rows(2)
                            ->helperText('Custom message when user clicks WhatsApp from modal')
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('badge_text')
                    ->searchable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\ImageColumn::make('banner_image')
                    ->label('Image')
                    ->circular(),

                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
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
            ->defaultSort('order', 'asc')
            ->groups([
                Tables\Grouping\Group::make('brand.name')
                    ->label('Brand')
                    ->collapsible(),
                Tables\Grouping\Group::make('category.title')
                    ->label('Category')
                    ->collapsible(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'title')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
