<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioCtaSettingResource\Pages;
use App\Models\PortfolioCtaSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioCtaSettingResource extends Resource
{
    protected static ?string $model = PortfolioCtaSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-up-right';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'CTA Settings';
    protected static ?int $navigationSort = 7;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('CTA Section')
                ->description('Configure the Call-to-Action strip at bottom')
                ->schema([
                    Forms\Components\TextInput::make('title')->label('CTA Title')->maxLength(255),
                    Forms\Components\TextInput::make('title_emphasis')->label('Title Emphasis (Italic)')->maxLength(255),
                    Forms\Components\Textarea::make('description')->label('CTA Description')->rows(2)->columnSpanFull(),
                    Forms\Components\Repeater::make('buttons')
                        ->label('CTA Buttons')
                        ->schema([
                            Forms\Components\TextInput::make('label')->label('Label')->required()->maxLength(100)->columnSpan(1),
                            Forms\Components\TextInput::make('url')->label('URL')->required()->maxLength(500)->columnSpan(2),
                            Forms\Components\TextInput::make('icon')->label('Icon')->default('bi-whatsapp')->columnSpan(1),
                            Forms\Components\Select::make('style')->label('Style')->options(['white' => 'White', 'outline' => 'Outline'])->default('white')->columnSpan(1),
                        ])->columns(4)->collapsible()->itemLabel(fn (array $state): ?string => ($state['label'] ?? ''))->defaultItems(2)->columnSpanFull(),
                    Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Title')->searchable()->limit(40),
            Tables\Columns\IconColumn::make('is_active')->label('Active')->boolean(),
            Tables\Columns\TextColumn::make('updated_at')->label('Last Updated')->dateTime('d M Y H:i')->sortable(),
        ])->filters([])->actions([Tables\Actions\EditAction::make()])->bulkActions([])->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePortfolioCtaSetting::route('/'),
            'edit' => Pages\EditPortfolioCtaSetting::route('/{record}/edit'),
        ];
    }
}
