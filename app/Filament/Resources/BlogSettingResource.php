<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogSettingResource\Pages;
use App\Models\BlogSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogSettingResource extends Resource
{
    protected static ?string $model = BlogSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Blog Management';

    protected static ?string $navigationLabel = 'Blog Settings';

    protected static ?int $navigationSort = 7;

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
                Forms\Components\Section::make('Hero Section')
                    ->description('Configure the hero section at top of Blog page')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->default('Blog & Artikel Resmi')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->default('Tips, Resep & Edukasi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_emphasis')
                            ->label('Title Emphasis (Italic)')
                            ->default('Seputar Memasak')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('stats')
                            ->label('Hero Stats')
                            ->schema([
                                Forms\Components\TextInput::make('number')
                                    ->label('Number')
                                    ->required()
                                    ->maxLength(50)
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('order')
                                    ->label('Order')
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['number'] ?? '') . ' - ' . ($state['label'] ?? ''))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('SEO Settings')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Recommended: 50-60 characters'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(2)
                            ->maxLength(160)
                            ->helperText('Recommended: 150-160 characters')
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
            'index' => Pages\ManageBlogSettings::route('/'),
            'edit' => Pages\EditBlogSetting::route('/{record}/edit'),
        ];
    }
}
