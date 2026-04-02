<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductHeroResource\Pages;
use App\Models\ProductHero;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductHeroResource extends Resource
{
    protected static ?string $model = ProductHero::class;

    protected static ?string $navigationIcon = 'heroicon-s-megaphone';

    protected static ?string $navigationGroup = 'Produk';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Product Hero';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Section')
                    ->description('Configure the hero section at top of product page')
                    ->schema([
                        Forms\Components\TextInput::make('badge_icon')
                            ->label('Badge Icon')
                            ->placeholder('bi-box-seam-fill')
                            ->maxLength(50)
                            ->helperText('Bootstrap icon class'),
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->default('Produk Kami')
                            ->maxLength(100),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Textarea::make('title')
                                    ->label('Title (First Part)')
                                    ->required()
                                    ->rows(2)
                                    ->placeholder('Pilihan Kemasan untuk')
                                    ->helperText('Text before the gradient span'),
                                Forms\Components\TextInput::make('title_gradient')
                                    ->label('Title (Gradient Text)')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('Setiap Kebutuhan')
                                    ->helperText('Text with gradient effect'),
                            ])->columns(2),
                        Forms\Components\Textarea::make('description')
                            ->label('Hero Description')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('badge_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([])
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
            'index' => Pages\ManageProductHero::route('/'),
            'create' => Pages\CreateProductHero::route('/create'),
            'edit' => Pages\EditProductHero::route('/{record}/edit'),
        ];
    }
}
