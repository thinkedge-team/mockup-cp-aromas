<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoHowtoSectionResource\Pages;
use App\Models\PromoHowtoSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoHowtoSectionResource extends Resource
{
    protected static ?string $model = PromoHowtoSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Promo';

    protected static ?string $navigationLabel = 'How to Claim';

    protected static ?int $navigationSort = 3;

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
                Forms\Components\Section::make('How to Claim Section')
                    ->description('Configure the "Cara Klaim" section')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('tag')
                            ->label('Section Tag')
                            ->default('Cara Klaim')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon')
                            ->default('bi-question-circle-fill')
                            ->placeholder('bi-question-circle-fill'),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->default('Cara Mendapatkan Promo AROMAS')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->default('Proses klaim mudah dan cepat — langsung hubungi kami via WhatsApp atau order melalui channel resmi.')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Steps')
                    ->description('Steps shown in the "Cara Klaim" section')
                    ->schema([
                        Forms\Components\Repeater::make('steps')
                            ->schema([
                                Forms\Components\TextInput::make('step_number')
                                    ->label('Step Number')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(1),
                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('order')
                                    ->label('Order')
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['step_number'] ?? '') . '. ' . ($state['title'] ?? ''))
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tag')
                    ->label('Tag')
                    ->searchable(),
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
            'index' => Pages\ManagePromoHowtoSections::route('/'),
            'create' => Pages\CreatePromoHowtoSection::route('/create'),
            'edit' => Pages\EditPromoHowtoSection::route('/{record}/edit'),
        ];
    }
}
