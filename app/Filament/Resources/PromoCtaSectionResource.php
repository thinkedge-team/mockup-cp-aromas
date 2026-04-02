<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoCtaSectionResource\Pages;
use App\Models\PromoCtaSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoCtaSectionResource extends Resource
{
    protected static ?string $model = PromoCtaSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationGroup = 'Promo';

    protected static ?string $navigationLabel = 'CTA Settings';

    protected static ?int $navigationSort = 4;

    protected static bool $shouldRegisterNavigation = true;

    public static function canCreate(): bool
    {
        return static::$model::count() === 0;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('CTA Section')
                    ->description('Configure the Call-to-Action strip at bottom')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->default('Ada Promo yang Menarik Perhatian Anda?')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->default('Jangan tunda! Hubungi tim kami sekarang dan klaim keuntungan terbaik AROMAS untuk Anda.')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('CTA Buttons')
                    ->description('Buttons shown in CTA section')
                    ->schema([
                        Forms\Components\Repeater::make('buttons')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->maxLength(500)
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon')
                                    ->default('bi-whatsapp')
                                    ->placeholder('bi-whatsapp')
                                    ->columnSpan(1),
                                Forms\Components\Select::make('style')
                                    ->label('Style')
                                    ->options([
                                        'w' => 'WhatsApp (Green)',
                                        'ol' => 'Outline (White)',
                                        'primary' => 'Primary (Green)',
                                    ])
                                    ->default('w')
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('order')
                                    ->label('Order')
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['label'] ?? ''))
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ManagePromoCtaSections::route('/'),
            'create' => Pages\CreatePromoCtaSection::route('/create'),
            'edit' => Pages\EditPromoCtaSection::route('/{record}/edit'),
        ];
    }
}
