<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThemeSettingResource\Pages;
use App\Filament\Resources\ThemeSettingResource\RelationManagers;
use App\Models\ThemeSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ThemeSettingResource extends Resource
{
    protected static ?string $model = ThemeSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    
    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?int $navigationSort = 4;
    
    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Theme Setting Details')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('setting_key')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z0-9_]+$/')
                            ->hint('Lowercase letters, numbers, and underscores only')
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('setting_type')
                            ->options([
                                'color' => 'Color',
                                'font' => 'Font Family',
                                'number' => 'Number (px, rem, etc)',
                                'boolean' => 'Boolean',
                                'select' => 'Select Dropdown',
                            ])
                            ->required()
                            ->default('color')
                            ->live()
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('group')
                            ->options([
                                'colors' => 'Colors',
                                'fonts' => 'Fonts',
                                'spacing' => 'Spacing & Layout',
                                'borders' => 'Borders & Radius',
                                'shadows' => 'Shadows',
                                'animations' => 'Animations',
                            ])
                            ->required()
                            ->default('colors')
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Value')
                    ->schema([
                        Forms\Components\ColorPicker::make('setting_value')
                            ->visible(fn (Forms\Get $get) => $get('setting_type') === 'color')
                            ->formatStateUsing(fn ($state) => ltrim($state, '#'))
                            ->dehydrateStateUsing(fn ($state): string => ltrim($state, '#'))
                            ->hexColor()
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('setting_value')
                            ->visible(fn (Forms\Get $get) => $get('setting_type') === 'font')
                            ->options([
                                'Poppins' => 'Poppins',
                                'Playfair Display' => 'Playfair Display',
                                'Inter' => 'Inter',
                                'Roboto' => 'Roboto',
                                'Open Sans' => 'Open Sans',
                                'Lato' => 'Lato',
                                'Montserrat' => 'Montserrat',
                                'Cormorant Garamond' => 'Cormorant Garamond',
                                'DM Sans' => 'DM Sans',
                                'DM Serif Display' => 'DM Serif Display',
                            ])
                            ->searchable()
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('setting_value')
                            ->visible(fn (Forms\Get $get) => in_array($get('setting_type'), ['number', 'select']))
                            ->maxLength(50)
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('setting_value')
                            ->visible(fn (Forms\Get $get) => $get('setting_type') === 'boolean')
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('setting_key')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('setting_type')
                    ->badge(),
                Tables\Columns\ColorColumn::make('setting_value')
                    ->visible(fn ($record) => $record->setting_type === 'color'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'colors' => 'Colors',
                        'fonts' => 'Fonts',
                        'spacing' => 'Spacing & Layout',
                        'borders' => 'Borders & Radius',
                        'shadows' => 'Shadows',
                    ]),
                Tables\Filters\SelectFilter::make('setting_type')
                    ->options([
                        'color' => 'Color',
                        'font' => 'Font',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                    ]),
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
            ])
            ->defaultSort('group', 'asc');
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
            'index' => Pages\ListThemeSettings::route('/'),
            'create' => Pages\CreateThemeSetting::route('/create'),
            'edit' => Pages\EditThemeSetting::route('/{record}/edit'),
        ];
    }
}
