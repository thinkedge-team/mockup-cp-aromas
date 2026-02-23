<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Filament\Resources\FooterSettingResource\RelationManagers;
use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    
    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?int $navigationSort = 3;
    
    protected static ?string $recordTitleAttribute = 'copyright_text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Footer Content')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Footer Logo')
                            ->image()
                            ->directory('footer/logo')
                            ->maxSize(5120)
                            ->imageResizeTargetWidth('200'),
                        
                        Forms\Components\Textarea::make('company_description')
                            ->label('Company Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('copyright_text')
                            ->label('Copyright Text')
                            ->placeholder('e.g., © 2024 AROMAS. All rights reserved.')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\KeyValue::make('contact_info')
                            ->label('Contact Info')
                            ->keyLabel('Field')
                            ->valueLabel('Value')
                            ->hint('Use keys: phone, email, address, whatsapp')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Link Columns')
                    ->description('Add footer link columns (e.g., Quick Links, Services, Support)')
                    ->schema([
                        Forms\Components\Repeater::make('link_columns')
                            ->label('Link Columns')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Column Title')
                                    ->placeholder('e.g., Quick Links')
                                    ->required()
                                    ->maxLength(50)
                                    ->columnSpanFull(),
                                
                                Forms\Components\Repeater::make('links')
                                    ->label('Links')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->placeholder('Link label')
                                            ->required()
                                            ->maxLength(50),
                                        Forms\Components\TextInput::make('url')
                                            ->placeholder('/url')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Toggle::make('open_in_new_tab')
                                            ->default(false),
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
                            ->columns(1)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->default([])
                            ->afterStateHydrated(function (Forms\Components\Repeater $component, $state) {
                                if (!is_array($state)) {
                                    $component->state([]);
                                }
                            })
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Social Media Links')
                    ->schema([
                        Forms\Components\Repeater::make('social_links')
                            ->label('Social Links')
                            ->schema([
                                Forms\Components\Select::make('platform')
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'instagram' => 'Instagram',
                                        'twitter' => 'Twitter',
                                        'youtube' => 'YouTube',
                                        'tiktok' => 'TikTok',
                                        'linkedin' => 'LinkedIn',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('url')
                                    ->label('Profile URL')
                                    ->url()
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon Class (optional)')
                                    ->placeholder('e.g., fab fa-facebook')
                                    ->maxLength(50),
                            ])
                            ->columns(2)
                            ->default([])
                            ->afterStateHydrated(function (Forms\Components\Repeater $component, $state) {
                                if (!is_array($state)) {
                                    $component->state([]);
                                }
                            })
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Legal Links')
                    ->schema([
                        Forms\Components\Repeater::make('legal_links')
                            ->label('Legal Links')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->placeholder('e.g., Privacy Policy')
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('url')
                                    ->placeholder('/privacy-policy')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2)
                            ->default([])
                            ->afterStateHydrated(function (Forms\Components\Repeater $component, $state) {
                                if (!is_array($state)) {
                                    $component->state([]);
                                }
                            })
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_description')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('copyright_text')
                    ->label('Copyright')
                    ->badge()
                    ->placeholder('Not set'),
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
            'index' => Pages\ListFooterSettings::route('/'),
            'create' => Pages\CreateFooterSetting::route('/create'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }
}
