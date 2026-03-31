<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationIcon = "heroicon-s-link";

    protected static ?string $navigationGroup = "Settings";

    protected static ?string $navigationLabel = "Footer Settings";

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Footer Content")
                ->schema([
                    Forms\Components\FileUpload::make("logo")
                        ->label("Site Logo (Navbar & Footer)")
                        ->helperText("Logo ini akan ditampilkan di navbar dan footer website")
                        ->image()
                        ->directory("footer/logo")
                        ->maxSize(5120)
                        ->imageResizeTargetWidth("200"),

                    Forms\Components\Textarea::make("company_description")
                        ->label("Company Description")
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make("copyright_text")
                        ->label("Copyright Text")
                        ->placeholder("e.g., © 2024 AROMAS. All rights reserved.")
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make("is_active")
                        ->label("Active")
                        ->default(true)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Forms\Components\Section::make("Contact Information")->schema([
                Forms\Components\TextInput::make("whatsapp_number")
                    ->label("WhatsApp Number")
                    ->placeholder("e.g., 6281234567890")
                    ->helperText("Format: Country code + number (e.g., 6281234567890)")
                    ->maxLength(20)
                    ->columnSpanFull(),

                Forms\Components\KeyValue::make("contact_info")
                    ->label("Contact Info")
                    ->keyLabel("Field")
                    ->valueLabel("Value")
                    ->default([
                        "phone" => "",
                        "email" => "",
                        "address" => "",
                        "whatsapp" => "",
                    ])
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make("Social Media Links")->schema([
                Forms\Components\KeyValue::make("social_links")
                    ->label("Social Media")
                    ->keyLabel("Platform")
                    ->valueLabel("Profile URL")
                    ->default([
                        "instagram" => "",
                        "facebook" => "",
                        "tiktok" => "",
                        "youtube" => "",
                    ])
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make("Legal Links")->schema([
                Forms\Components\KeyValue::make("legal_links")
                    ->label("Legal Links")
                    ->keyLabel("Link Label")
                    ->valueLabel("URL")
                    ->default([
                        "privacy" => "/privacy",
                        "terms" => "/terms",
                    ])
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("company_description")
                    ->label("Description")
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make("copyright_text")
                    ->label("Copyright")
                    ->badge()
                    ->placeholder("Not set"),
                Tables\Columns\IconColumn::make("is_active")
                    ->label("Active")
                    ->boolean()
                    ->sortable(),
            ])
            ->actions([])
            ->bulkActions([])
            ->filters([])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ManageFooterSetting::route("/"),
            "create" => Pages\CreateFooterSetting::route("/create"),
            "edit" => Pages\EditFooterSetting::route("/{record}/edit"),
        ];
    }
}
