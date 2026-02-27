<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoFilterCategoryResource\Pages;
use App\Models\PromoFilterCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoFilterCategoryResource extends Resource
{
    protected static ?string $model = PromoFilterCategory::class;

    protected static ?string $navigationIcon = "heroicon-s-funnel";

    protected static ?string $navigationGroup = "Promo Management";

    protected static ?string $navigationLabel = "Filter Categories";

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Category Information")
                ->description("Filter categories untuk promo.")
                ->schema([
                    Forms\Components\TextInput::make("name")
                        ->required()
                        ->maxLength(100)
                        ->live(onBlur: true)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make("icon")
                        ->required()
                        ->default("bi-grid-fill")
                        ->placeholder("bi-grid-fill")
                        ->helperText(
                            "Bootstrap Icon class (e.g., bi-truck, bi-percent)",
                        ),
                    Forms\Components\TextInput::make("sort_order")
                        ->required()
                        ->numeric()
                        ->default(0)
                        ->helperText("Lower numbers appear first"),
                    Forms\Components\Toggle::make("is_active")
                        ->label("Active")
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label("Category Name")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("icon")->searchable(),
                Tables\Columns\TextColumn::make("sort_order")
                    ->label("Order")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make("is_active")
                    ->label("Active")
                    ->boolean(),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort("sort_order", "asc")
            ->filters([
                Tables\Filters\TernaryFilter::make("is_active")->label(
                    "Active",
                ),
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
            "index" => Pages\ListPromoFilterCategories::route("/"),
            "create" => Pages\CreatePromoFilterCategory::route("/create"),
            "edit" => Pages\EditPromoFilterCategory::route("/{record}/edit"),
        ];
    }
}
