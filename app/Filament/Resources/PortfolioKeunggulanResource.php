<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioKeunggulanResource\Pages;
use App\Models\PortfolioKeunggulan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioKeunggulanResource extends Resource
{
    protected static ?string $model = PortfolioKeunggulan::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Keunggulan';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Keunggulan')
                ->schema([
                    Forms\Components\TextInput::make('icon')->label('Icon Class')->placeholder('bi-award-fill')->helperText('Bootstrap Icon class')->columnSpan(1),
                    Forms\Components\TextInput::make('title')->label('Title')->required()->maxLength(255)->columnSpan(1),
                    Forms\Components\Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    Forms\Components\TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->helperText('1-4 for display order')->columnSpan(1),
                    Forms\Components\Toggle::make('is_active')->label('Active')->default(true)->columnSpan(1),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('sort_order')->label('Order')->numeric()->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Active')->boolean()->sortable(),
        ])->defaultSort('sort_order', 'asc')->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListPortfolioKeunggulan::route('/')];
    }
}
