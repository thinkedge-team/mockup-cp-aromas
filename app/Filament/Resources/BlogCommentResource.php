<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogCommentResource\Pages;
use App\Models\BlogComment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogCommentResource extends Resource
{
    protected static ?string $model = BlogComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationLabel = 'Comments';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Comment Details')
                    ->schema([
                        Forms\Components\Select::make('post_id')
                            ->label('Post')
                            ->relationship('post', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('parent_id')
                            ->label('Parent Comment (for replies)')
                            ->relationship('parent', 'author_name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Top-level comment')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('author_name')
                            ->label('Author Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author_email')
                            ->label('Author Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('content')
                            ->label('Comment')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_approved')
                            ->label('Approved')
                            ->default(false),
                        Forms\Components\Toggle::make('is_verified')
                            ->label('Verified User')
                            ->default(false),
                        Forms\Components\Toggle::make('is_official')
                            ->label('Official Reply')
                            ->default(false)
                            ->helperText('Mark as official response from team'),
                        Forms\Components\Toggle::make('is_hidden')
                            ->label('Hidden')
                            ->default(false)
                            ->helperText('Hide from public view (requires approval to show)'),
                        Forms\Components\TextInput::make('likes')
                            ->label('Likes')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('post.title')
                    ->label('Post')
                    ->limit(30)
                    ->sortable(),
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Comment')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_official')
                    ->label('Official')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_hidden')
                    ->label('Hidden')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('likes')
                    ->label('Likes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('post')
                    ->relationship('post', 'title')
                    ->label('Post'),
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Approved'),
                Tables\Filters\TernaryFilter::make('is_official')
                    ->label('Official'),
                Tables\Filters\TernaryFilter::make('is_hidden')
                    ->label('Hidden'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('approveSelected')
                        ->label('Approve Selected')
                        ->icon('heroicon-m-check-circle')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_approved' => true])),
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
            'index' => Pages\ListBlogComments::route('/'),
            'edit' => Pages\EditBlogComment::route('/{record}/edit'),
        ];
    }
}
