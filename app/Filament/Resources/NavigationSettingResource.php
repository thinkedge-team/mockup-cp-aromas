<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationSettingResource\Pages;
use App\Filament\Resources\NavigationSettingResource\RelationManagers;
use App\Models\NavigationSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NavigationSettingResource extends Resource
{
    protected static ?string $model = NavigationSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    
    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $recordTitleAttribute = 'location';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Navigation Settings')
                    ->schema([
                        Forms\Components\Select::make('location')
                            ->options([
                                'header' => 'Header (Main Navigation)',
                                'footer' => 'Footer Navigation',
                                'mobile' => 'Mobile Navigation',
                            ])
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->default('header')
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Logo & Branding')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo Image')
                            ->image()
                            ->directory('navigation/logos')
                            ->maxSize(5120) // 5MB
                            ->imageResizeTargetWidth('200')
                            ->helperText('Recommended: PNG or SVG with transparent background'),
                        
                        Forms\Components\TextInput::make('logo_height')
                            ->label('Logo Height (px)')
                            ->numeric()
                            ->default(44)
                            ->minValue(20)
                            ->maxValue(100),
                    ])->columns(2),

                Forms\Components\Section::make('Call to Action Button')
                    ->schema([
                        Forms\Components\TextInput::make('cta_button_text')
                            ->label('Button Text')
                            ->placeholder('e.g., Partnership')
                            ->maxLength(50),
                        
                        Forms\Components\TextInput::make('cta_button_url')
                            ->label('Button URL')
                            ->placeholder('/partnership')
                            ->url()
                            ->prefix('/'),
                    ])->columns(2),

                Forms\Components\Section::make('Menu Items')
                    ->description('Add navigation menu items. Drag to reorder.')
                    ->schema([
                        Forms\Components\Repeater::make('menu_items')
                            ->label('Menu Items')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Menu Label')
                                    ->placeholder('e.g., Beranda')
                                    ->required()
                                    ->maxLength(50)
                                    ->columnSpanFull(),
                                
                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->placeholder('e.g., /about or https://...')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon (optional)')
                                    ->placeholder('e.g., heroicon-o-home')
                                    ->maxLength(50)
                                    ->hint('FontAwesome or Heroicon class'),
                                
                                Forms\Components\TextInput::make('order')
                                    ->label('Order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                                
                                Forms\Components\Toggle::make('open_in_new_tab')
                                    ->label('Open in new tab')
                                    ->default(false),
                                
                                Forms\Components\Repeater::make('dropdown_items')
                                    ->label('Dropdown Items')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->placeholder('Dropdown item label')
                                            ->required()
                                            ->maxLength(50),
                                        Forms\Components\TextInput::make('url')
                                            ->placeholder('/url')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('icon')
                                            ->placeholder('icon class')
                                            ->maxLength(50),
                                    ])
                                    ->columns(1)
                                    ->default([])
                                    ->afterStateHydrated(function (Forms\Components\Repeater $component, $state) {
                                        if (!is_array($state)) {
                                            $component->state([]);
                                        }
                                    })
                                    ->collapsible(),
                            ])
                            ->columns(2)
                            ->reorderable('order')
                            ->reorderableWithDragAndDrop()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->default([])
                            ->afterStateHydrated(function (Forms\Components\Repeater $component, $state) {
                                if (!is_array($state)) {
                                    $component->state([]);
                                }
                            })
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Behavior')
                    ->schema([
                        Forms\Components\Toggle::make('is_sticky')
                            ->label('Sticky Header (Fixed on scroll)')
                            ->default(true)
                            ->helperText('When enabled, navigation stays fixed at top'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('location')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cta_button_text')
                    ->label('CTA Button')
                    ->badge()
                    ->placeholder('No CTA'),
                Tables\Columns\IconColumn::make('is_sticky')
                    ->label('Sticky')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('location')
                    ->options([
                        'header' => 'Header',
                        'footer' => 'Footer',
                        'mobile' => 'Mobile',
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
            'index' => Pages\ListNavigationSettings::route('/'),
            'create' => Pages\CreateNavigationSetting::route('/create'),
            'edit' => Pages\EditNavigationSetting::route('/{record}/edit'),
        ];
    }
}
