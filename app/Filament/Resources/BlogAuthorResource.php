<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogAuthorResource\Pages;
use App\Models\BlogAuthor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class BlogAuthorResource extends Resource
{
    protected static ?string $model = BlogAuthor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Blog Management';

    protected static ?string $navigationLabel = 'Authors';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Author Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Str::slug($state)))
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\FileUpload::make('avatar')
                            ->label('Avatar')
                            ->image()
                            ->directory('blog/authors')
                            ->maxSize(2048),
                        Forms\Components\TextInput::make('initials')
                            ->label('Initials')
                            ->helperText('For avatar fallback (e.g., "JS" for John Smith)')
                            ->maxLength(10),
                        Forms\Components\TextInput::make('role')
                            ->label('Role/Title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('bio')
                            ->label('Biography')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Social Media')
                    ->schema([
                        Forms\Components\TextInput::make('instagram')
                            ->label('Instagram Username')
                            ->placeholder('@username')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('linkedin')
                            ->label('LinkedIn URL')
                            ->placeholder('linkedin.com/in/username')
                            ->maxLength(500),
                        Forms\Components\TextInput::make('twitter')
                            ->label('Twitter/X Username')
                            ->placeholder('@username')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->searchable(),
                TextColumn::make('initials')
                    ->label('Initials'),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ReplicateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogAuthors::route('/'),
            'create' => Pages\CreateBlogAuthor::route('/create'),
            'edit' => Pages\EditBlogAuthor::route('/{record}/edit'),
        ];
    }
}
