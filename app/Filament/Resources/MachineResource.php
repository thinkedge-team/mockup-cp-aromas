<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MachineResource\Pages;
use App\Models\Machine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MachineResource extends Resource
{
    protected static ?string $model = Machine::class;

    protected static ?string $navigationIcon = "heroicon-o-cog-6-tooth";

    protected static ?string $navigationGroup = "Our Machine";

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = "Machines";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Basic Information")
                ->schema([
                    Forms\Components\Select::make("category_id")
                        ->relationship("category", "name")
                        ->required()
                        ->label("Category"),
                    Forms\Components\TextInput::make("name")
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make("tagline")
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make("unit_count")
                        ->required()
                        ->numeric()
                        ->default(1),
                    Forms\Components\TextInput::make("capacity_badge")
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make("order")
                        ->required()
                        ->numeric()
                        ->default(0),
                    Forms\Components\Toggle::make("is_active")
                        ->label("Active")
                        ->default(true),
                ])
                ->columns(2),

            Forms\Components\Section::make("Machine Images")
                ->description(
                    'Product images - first image with "Set as Primary" will be shown on card',
                )
                ->schema([
                    Forms\Components\Repeater::make("images")
                        ->schema([
                            Forms\Components\FileUpload::make("url")
                                ->label("Image")
                                ->image()
                                ->directory("machines")
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make("order")
                                ->label("Display Order")
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                            Forms\Components\Toggle::make("is_primary")
                                ->label("Set as Primary")
                                ->default(false)
                                ->helperText(
                                    "First image with this enabled will be shown on card",
                                )
                                ->columnSpan(1),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->itemLabel(
                            fn(array $state): ?string => $state["is_primary"]
                                ? "🏷️ Primary Image"
                                : "📷 Gallery Image",
                        )
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make("Specifications")
                ->description("Technical specifications shown on card")
                ->schema([
                    Forms\Components\Repeater::make("specs")
                        ->schema([
                            Forms\Components\TextInput::make("label")
                                ->label("Label")
                                ->required()
                                ->maxLength(100)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("value")
                                ->label("Value")
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("order")
                                ->label("Order")
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(3)
                        ->collapsible()
                        ->itemLabel(
                            fn(array $state): ?string => ($state["label"] ??
                                "") .
                                ": " .
                                ($state["value"] ?? ""),
                        )
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make("Components")
                ->description("Main components/parts of the machine")
                ->schema([
                    Forms\Components\Repeater::make("components")
                        ->schema([
                            Forms\Components\TextInput::make("name")
                                ->label("Component Name")
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make("order")
                                ->label("Order")
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->collapsible()
                        ->itemLabel(
                            fn(array $state): ?string => $state["name"] ?? null,
                        )
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make("Modal Content")
                ->description("Content shown in machine detail modal")
                ->schema([
                    Forms\Components\TextInput::make("modal_title")
                        ->label("Modal Title")
                        ->maxLength(255),
                    Forms\Components\TextInput::make("modal_subtitle")
                        ->label("Modal Subtitle")
                        ->maxLength(255),
                    Forms\Components\Textarea::make("modal_description")
                        ->label("Modal Description")
                        ->rows(4)
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make("whatsapp_message")
                        ->label("WhatsApp Message")
                        ->rows(2)
                        ->helperText(
                            "Custom message when user clicks WhatsApp from modal",
                        )
                        ->columnSpanFull(),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")->label("ID")->sortable(),
                Tables\Columns\TextColumn::make("name")
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make("category.name")
                    ->label("Category")
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make("capacity_badge")
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make("unit_count")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make("order")->numeric()->sortable(),
                Tables\Columns\IconColumn::make("is_active")
                    ->label("Active")
                    ->boolean(),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort("order", "asc")
            ->filters([
                Tables\Filters\SelectFilter::make("category")
                    ->relationship("category", "name")
                    ->label("Category"),
                Tables\Filters\TernaryFilter::make("is_active")->label(
                    "Active",
                ),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->poll("10s");
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListMachines::route("/"),
            "create" => Pages\CreateMachine::route("/create"),
            "edit" => Pages\EditMachine::route("/{record}/edit"),
        ];
    }
}
