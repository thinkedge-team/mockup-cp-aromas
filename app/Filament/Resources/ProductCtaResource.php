<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCtaResource\Pages;
use App\Models\ProductCta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductCtaResource extends Resource
{
    protected static ?string $model = ProductCta::class;

    protected static ?string $navigationIcon = 'heroicon-s-phone';

    protected static ?string $navigationGroup = 'Produk';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Product CTA';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('CTA Section')
                    ->description('Configure the call-to-action section at bottom of product page')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('CTA Title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('CTA Description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('primary_button_text')
                                    ->label('Primary Button Text')
                                    ->default('Chat WhatsApp'),
                                Forms\Components\TextInput::make('primary_button_url')
                                    ->label('Primary Button URL')
                                    ->default('https://wa.me/6281234567890')
                                    ->url(),
                                Forms\Components\TextInput::make('primary_button_icon')
                                    ->label('Primary Button Icon')
                                    ->placeholder('bi-whatsapp')
                                    ->default('bi-whatsapp')
                                    ->helperText('Masukkan nama icon dari Bootstrap Icons. Contoh: bi-whatsapp, bi-telephone-fill')
                                    ->suffixAction(
                                        Forms\Components\Actions\Action::make('browse_icons_primary')
                                            ->label('Browse')
                                            ->icon('heroicon-m-magnifying-glass')
                                            ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                                            ->color('primary')
                                    ),
                            ])->columns(3),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('secondary_button_text')
                                    ->label('Secondary Button Text')
                                    ->default('Telepon Kami'),
                                Forms\Components\TextInput::make('secondary_button_url')
                                    ->label('Secondary Button URL')
                                    ->default('tel:02112345678')
                                    ->url(),
                                Forms\Components\TextInput::make('secondary_button_icon')
                                    ->label('Secondary Button Icon')
                                    ->placeholder('bi-envelope-fill')
                                    ->default('bi-envelope-fill')
                                    ->helperText('Masukkan nama icon dari Bootstrap Icons. Contoh: bi-envelope-fill, bi-chat-dots')
                                    ->suffixAction(
                                        Forms\Components\Actions\Action::make('browse_icons_secondary')
                                            ->label('Browse')
                                            ->icon('heroicon-m-magnifying-glass')
                                            ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                                            ->color('primary')
                                    ),
                            ])->columns(3),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('primary_button_text')
                    ->searchable(),
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
            'index' => Pages\ManageProductCta::route('/'),
            'create' => Pages\CreateProductCta::route('/create'),
            'edit' => Pages\EditProductCta::route('/{record}/edit'),
        ];
    }
}
