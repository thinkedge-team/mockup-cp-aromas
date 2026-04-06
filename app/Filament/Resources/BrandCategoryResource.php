<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandCategoryResource\Pages;
use App\Models\BrandCategory;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BrandCategoryResource extends Resource
{
    protected static ?string $model = BrandCategory::class;

    protected static ?string $navigationIcon = 'heroicon-s-link';

    protected static ?string $navigationGroup = 'Produk';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Brand Categories';

    protected static ?string $modelLabel = 'Brand Category';

    protected static ?string $pluralModelLabel = 'Brand Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Brand-Category Combination')
                    ->description('Link a brand to a category with specific ordering and status')
                    ->schema([
                        Forms\Components\Select::make('brand_id')
                            ->label('Brand')
                            ->options(ProductBrand::orderBy('order')->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->preload()
                            ->helperText('Select the brand'),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(ProductCategory::orderBy('order')->pluck('title', 'id'))
                            ->searchable()
                            ->required()
                            ->preload()
                            ->helperText('Select the category for this brand'),

                        Forms\Components\TextInput::make('order')
                            ->label('Order')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('Order of this category within the brand (lower = first)'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('If disabled, products with this brand+category combination will not be displayed'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                Tables\Columns\ImageColumn::make('brand.logo')
                    ->label('Logo')
                    ->circular()
                    ->size(32),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('product_count')
                    ->label('Products')
                    ->getStateUsing(fn($record) => $record->product_count)
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('brand_id')
            ->groups([
                Tables\Grouping\Group::make('brand.name')
                    ->label('Brand')
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
                    ->label('Active Status')
                    ->boolean()
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn($records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn($records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation(),

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
            'index' => Pages\ListBrandCategories::route('/'),
            'create' => Pages\CreateBrandCategory::route('/create'),
            'edit' => Pages\EditBrandCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
