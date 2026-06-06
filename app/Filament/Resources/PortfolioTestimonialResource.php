<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioTestimonialResource\Pages;
use App\Models\PortfolioTestimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Forms\Components\ImageUpload;

class PortfolioTestimonialResource extends Resource
{
    protected static ?string $model = PortfolioTestimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Testimonials';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Testimonial Content')
                ->schema([
                    Forms\Components\TextInput::make('author_name')->label('Author Name')->required()->maxLength(255)->columnSpan(1),
                    Forms\Components\TextInput::make('author_role')->label('Author Role')->maxLength(255)->columnSpan(1),
                    ImageUpload::make('author_avatar')->label('Avatar')->image()->directory('portfolio/avatars')->maxSize(2048)->columnSpanFull(),
                    Forms\Components\Textarea::make('testimonial_text')->label('Testimonial Text')->required()->rows(4)->columnSpanFull(),
                    Forms\Components\TextInput::make('rating')->label('Rating')->numeric()->default(5.0)->minValue(0)->maxValue(5)->step(0.1)->columnSpan(1),
                    Forms\Components\TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->columnSpan(1),
                    Forms\Components\Toggle::make('is_active')->label('Active')->default(true)->columnSpan(1),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('author_avatar')->label('Avatar')->circular(),
            Tables\Columns\TextColumn::make('author_name')->label('Author')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('author_role')->label('Role')->searchable(),
            Tables\Columns\TextColumn::make('rating')->label('Rating')->numeric()->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Active')->boolean()->sortable(),
            Tables\Columns\TextColumn::make('sort_order')->label('Order')->numeric()->sortable(),
        ])->defaultSort('sort_order', 'asc')->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListPortfolioTestimonials::route('/')];
    }
}
