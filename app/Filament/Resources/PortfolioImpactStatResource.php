<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioImpactStatResource\Pages;
use App\Models\PortfolioImpactStat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioImpactStatResource extends Resource
{
    protected static ?string $model = PortfolioImpactStat::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Impact Stats';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Impact Stat')
                ->schema([
                    Forms\Components\FileUpload::make('image')->label('Background Image')->image()->directory('portfolio/impact')->maxSize(5120)->columnSpanFull(),
                    Forms\Components\TextInput::make('number')->label('Number (e.g., "15+", "1Jt+")')->required()->maxLength(50)->columnSpan(1),
                    Forms\Components\TextInput::make('label')->label('Label')->required()->maxLength(255)->columnSpan(1),
                    Forms\Components\TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->helperText('1-4 for display order')->columnSpan(1),
                    Forms\Components\Toggle::make('is_active')->label('Active')->default(true)->columnSpan(1),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')->label('Image')->circular(),
            Tables\Columns\TextColumn::make('number')->label('Number')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('label')->label('Label')->searchable(),
            Tables\Columns\TextColumn::make('sort_order')->label('Order')->numeric()->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Active')->boolean()->sortable(),
        ])->defaultSort('sort_order', 'asc')->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListPortfolioImpactStats::route('/')];
    }
}
