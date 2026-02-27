<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoHeroSettingResource\Pages;
use App\Models\PromoHeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoHeroSettingResource extends Resource
{
    protected static ?string $model = PromoHeroSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Promo Management';

    protected static ?string $navigationLabel = "Hero Settings";

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    public static function canCreate(): bool
    {
        return static::$model::count() === 0;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Hero Content")
                ->schema([
                    Forms\Components\TextInput::make("badge_text")
                        ->required()
                        ->maxLength(100)
                        ->default("Penawaran Terbatas"),
                    Forms\Components\TextInput::make("badge_icon")
                        ->required()
                        ->default("bi-lightning-charge-fill")
                        ->placeholder("bi-lightning-charge-fill"),
                    Forms\Components\TextInput::make("title")
                        ->required()
                        ->maxLength(255)
                        ->default("Promo Spesial AROMAS"),
                    Forms\Components\Textarea::make("description")
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Forms\Components\Section::make("Countdown Settings")
                ->schema([
                    Forms\Components\TextInput::make("countdown_label")
                        ->required()
                        ->maxLength(100)
                        ->default("Promo berakhir dalam"),
                    Forms\Components\DateTimePicker::make(
                        "countdown_target",
                    )->label("Countdown Target"),
                ])
                ->columns(2),

            Forms\Components\Section::make("Hero Stats")
                ->description("Statistics shown in hero section")
                ->schema([
                    Forms\Components\Repeater::make("stats")
                        ->schema([
                            Forms\Components\TextInput::make("icon")
                                ->label("Icon Class")
                                ->required()
                                ->default("bi-ticket-perforated-fill")
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("value")
                                ->label('Value (e.g., "6 Promo")')
                                ->required()
                                ->maxLength(100)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("label")
                                ->label('Label (e.g., "Aktif Saat Ini")')
                                ->required()
                                ->maxLength(100)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("order")
                                ->label("Order")
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->collapsible()
                        ->itemLabel(
                            fn(array $state): ?string => ($state["value"] ??
                                "") .
                                " - " .
                                ($state["label"] ?? ""),
                        )
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Forms\Components\Section::make("Floating Tags")
                ->description("Animated floating badges")
                ->schema([
                    Forms\Components\Repeater::make("float_tags")
                        ->schema([
                            Forms\Components\TextInput::make("icon")
                                ->label("Icon Class")
                                ->required()
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("text")
                                ->label("Text")
                                ->required()
                                ->maxLength(50)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("position")
                                ->label("Position (e.g., hft1, hft2)")
                                ->required()
                                ->default("hft1")
                                ->columnSpan(1),
                            Forms\Components\TextInput::make("order")
                                ->label("Order")
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->collapsible()
                        ->itemLabel(
                            fn(array $state): ?string => ($state["text"] ??
                                "") .
                                " - " .
                                ($state["position"] ?? ""),
                        )
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Forms\Components\Section::make("Appearance")
                ->schema([
                    Forms\Components\TextInput::make("background_color_start")
                        ->label("Background Start Color")
                        ->default("#1a2e1a")
                        ->placeholder("#1a2e1a")
                        ->columnSpan(1),
                    Forms\Components\TextInput::make("background_color_end")
                        ->label("Background End Color")
                        ->default("#15412a")
                        ->placeholder("#15412a")
                        ->columnSpan(1),
                    Forms\Components\Toggle::make("is_active")
                        ->label("Active")
                        ->default(true)
                        ->columnSpan(1),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("title")
                    ->label("Title")
                    ->searchable(),
                Tables\Columns\TextColumn::make("badge_text")
                    ->label("Badge")
                    ->searchable(),
                Tables\Columns\TextColumn::make("countdown_target")
                    ->label("Countdown Target")
                    ->dateTime("d M Y H:i")
                    ->sortable(),
                Tables\Columns\IconColumn::make("is_active")
                    ->label("Active")
                    ->boolean(),
                Tables\Columns\TextColumn::make("updated_at")
                    ->label("Last Updated")
                    ->dateTime("d M Y H:i")
                    ->sortable(),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ManagePromoHeroSettings::route("/"),
            "create" => Pages\CreatePromoHeroSetting::route("/create"),
            "edit" => Pages\EditPromoHeroSetting::route("/{record}/edit"),
        ];
    }
}
