<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoCampaignResource\Pages;
use App\Models\PromoCampaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoCampaignResource extends Resource
{
    protected static ?string $model = PromoCampaign::class;

    protected static ?string $navigationIcon = "heroicon-s-gift";

    protected static ?string $navigationGroup = "Promo";

    protected static ?string $navigationLabel = "Promo Campaigns";

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Basic Information")
                ->schema([
                    Forms\Components\TextInput::make("name")
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(
                            fn(Forms\Set $set, ?string $state) => $set(
                                "slug",
                                \Str::slug($state),
                            ),
                        ),
                    Forms\Components\TextInput::make("slug")
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make("promo_category_id")
                        ->label("Category")
                        ->relationship("category", "name")
                        ->required()
                        ->native(false)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make("tagline")
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make("description")
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Forms\Components\Section::make("Discount & Pricing")
                ->schema([
                    Forms\Components\TextInput::make("discount_percentage")
                        ->label("Discount Percentage")
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->suffix("%"),
                    Forms\Components\TextInput::make("discount_value")
                        ->label("Discount Value (Rp)")
                        ->numeric()
                        ->prefix("Rp"),
                    Forms\Components\TextInput::make("code")
                        ->label("Promo Code")
                        ->maxLength(50)
                        ->helperText("Leave empty if no code required"),
                    Forms\Components\TextInput::make("min_purchase")
                        ->label("Minimum Purchase (Rp)")
                        ->numeric()
                        ->prefix("Rp"),
                ])
                ->columns(4),

            Forms\Components\Section::make("Dates & Status")
                ->schema([
                    Forms\Components\DatePicker::make("start_date")->label(
                        "Start Date",
                    ),
                    Forms\Components\DatePicker::make("end_date")->label(
                        "End Date",
                    ),
                    Forms\Components\Toggle::make("is_active")
                        ->label("Active")
                        ->default(true),
                    Forms\Components\Toggle::make("is_featured")
                        ->label("Featured (Show in Banner)")
                        ->default(false),
                    Forms\Components\Select::make("status_badge")
                        ->options([
                            "aktif" => "Aktif",
                            "terbatas" => "Terbatas",
                            "flash" => "Flash Sale",
                        ])
                        ->default("aktif")
                        ->required(),
                    Forms\Components\TextInput::make("sort_order")
                        ->required()
                        ->numeric()
                        ->default(0)
                        ->helperText("Lower numbers appear first"),
                ])
                ->columns(3),

            Forms\Components\Section::make("Images")
                ->description(
                    "Promo images - first image will be shown on card",
                )
                ->schema([
                    Forms\Components\Repeater::make("images")
                        ->schema([
                            Forms\Components\FileUpload::make("url")
                                ->label("Image")
                                ->image()
                                ->directory("promos")
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make("order")
                                ->label("Display Order")
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("caption")
                                ->label("Caption")
                                ->maxLength(255)
                                ->columnSpan(1),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->itemLabel(
                            fn(array $state): ?string => $state["caption"] ??
                                "Image",
                        )
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Forms\Components\Section::make("Details")
                ->description(
                    "Key-value pairs shown in modal (e.g., Area, Min Purchase)",
                )
                ->schema([
                    Forms\Components\Repeater::make("details")
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
                ])
                ->columnSpanFull(),

            Forms\Components\Section::make("Terms & Conditions")
                ->description("List of terms and conditions")
                ->schema([
                    Forms\Components\Repeater::make("terms")
                        ->schema([
                            Forms\Components\Textarea::make("description")
                                ->label("Description")
                                ->required()
                                ->rows(2)
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
                            fn(array $state): ?string => $state[
                                "description"
                            ] ?? null,
                        )
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Forms\Components\Section::make("Call to Action")
                ->schema([
                    Forms\Components\Textarea::make("whatsapp_message")
                        ->label("WhatsApp Message")
                        ->rows(2)
                        ->helperText(
                            "Pre-filled message when user clicks WhatsApp",
                        ),
                    Forms\Components\TextInput::make("button_label")
                        ->label("Button Label")
                        ->default("Lihat Detail")
                        ->maxLength(100),
                    Forms\Components\TextInput::make("button_link")
                        ->label("Custom Button Link (optional)")
                        ->helperText("Leave empty to use modal"),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label("Promo Name")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("category.name")
                    ->label("Category")
                    ->sortable(),
                Tables\Columns\TextColumn::make("tagline")
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make("discount_percentage")
                    ->label("Discount %")
                    ->numeric()
                    ->sortable()
                    ->suffix("%")
                    ->placeholder("-"),
                Tables\Columns\TextColumn::make("end_date")
                    ->label("End Date")
                    ->date("d M Y")
                    ->sortable()
                    ->color(
                        fn(?string $state): string => $state &&
                        now()->gt($state)
                            ? "danger"
                            : "success",
                    ),
                Tables\Columns\IconColumn::make("is_active")
                    ->label("Active")
                    ->boolean(),
                Tables\Columns\IconColumn::make("is_featured")
                    ->label("Featured")
                    ->boolean(),
                Tables\Columns\TextColumn::make("status_badge")
                    ->badge()
                    ->formatStateUsing(
                        fn(string $state): string => match ($state) {
                            "aktif" => "Aktif",
                            "terbatas" => "Terbatas",
                            "flash" => "Flash",
                            default => $state,
                        },
                    ),
                Tables\Columns\TextColumn::make("sort_order")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort("sort_order", "asc")
            ->filters([
                Tables\Filters\SelectFilter::make('promo_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListPromoCampaigns::route("/"),
            "create" => Pages\CreatePromoCampaign::route("/create"),
            "edit" => Pages\EditPromoCampaign::route("/{record}/edit"),
        ];
    }
}
