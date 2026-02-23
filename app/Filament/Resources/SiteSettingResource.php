<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Setting Details')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('type')
                            ->options([
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'rich_text' => 'Rich Text',
                                'image' => 'Image',
                                'number' => 'Number',
                                'boolean' => 'Boolean (Yes/No)',
                                'array' => 'Array (Key-Value)',
                                'social' => 'Social Media Links',
                                'contact' => 'Contact Info',
                            ])
                            ->required()
                            ->default('text')
                            ->live()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('group')
                            ->options([
                                'general' => 'General',
                                'contact' => 'Contact',
                                'social' => 'Social Media',
                                'branding' => 'Branding',
                                'seo' => 'SEO',
                            ])
                            ->required()
                            ->default('general')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),
                    ])->columns(1),
                
                Forms\Components\Section::make('Value')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->visible(fn (Forms\Get $get) => in_array($get('type'), ['text', 'number', 'email', 'url', 'tel']))
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('value')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'textarea')
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        Forms\Components\RichEditor::make('value')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'rich_text')
                            ->columnSpanFull(),
                        
                        Forms\Components\FileUpload::make('value')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'image')
                            ->image()
                            ->directory('site-settings')
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('value')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'boolean')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->columnSpanFull(),
                        
                        Forms\Components\KeyValue::make('value')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'array')
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->default([])
                            ->afterStateHydrated(function (Forms\Components\KeyValue $component, $state) {
                                if (!is_array($state)) {
                                    $component->state([]);
                                }
                            })
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('value')
                            ->visible(fn (Forms\Get $get) => in_array($get('type'), ['social', 'contact']))
                            ->helperText('Enter JSON format. Example: [{"platform":"facebook","url":"https://..."}]')
                            ->rows(6)
                            ->json()
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
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
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
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Social Media',
                        'branding' => 'Branding',
                        'seo' => 'SEO',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'rich_text' => 'Rich Text',
                        'image' => 'Image',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                        'array' => 'Array',
                        'social' => 'Social Media',
                        'contact' => 'Contact Info',
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
            ->defaultSort('order', 'asc');
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
