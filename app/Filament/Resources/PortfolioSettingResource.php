<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioSettingResource\Pages;
use App\Models\PortfolioSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioSettingResource extends Resource
{
    protected static ?string $model = PortfolioSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Portofolio';

    protected static ?string $navigationLabel = 'Portfolio Settings';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Section')
                    ->description('Configure the hero section at top of Portfolio page')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->default('Portofolio Kemitraan')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('badge_icon')
                            ->label('Badge Icon')
                            ->default('bi-briefcase-fill')
                            ->placeholder('bi-briefcase-fill')
                            ->helperText('Bootstrap Icon class'),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->default('Dipercaya Ribuan Mitra')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_emphasis')
                            ->label('Title Emphasis (Italic)')
                            ->default('Di Seluruh Indonesia')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('stats')
                            ->label('Hero Stats')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon Class')
                                    ->default('bi-people-fill')
                                    ->placeholder('bi-people-fill')
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('number')
                                    ->label('Number (e.g., "1Jt+")')
                                    ->required()
                                    ->maxLength(50)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(2),
                            ])
                            ->columns(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['number'] ?? '') . ' - ' . ($state['label'] ?? ''))
                            ->defaultItems(4)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('badge_text')
                    ->label('Badge')
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
            'index' => Pages\ManagePortfolioSetting::route('/'),
            'edit' => Pages\EditPortfolioSetting::route('/{record}/edit'),
        ];
    }
}
