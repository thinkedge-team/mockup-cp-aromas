<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MachineCtaResource\Pages;
use App\Models\MachineCta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MachineCtaResource extends Resource
{
    protected static ?string $model = MachineCta::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Mesin';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Machine CTA';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('CTA Section')
                    ->description('Configure the call-to-action section at bottom of Our Machine page')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('CTA Title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('CTA Description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('primary_button_text')
                                    ->label('Primary Button Text')
                                    ->default('Jadwalkan Kunjungan')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('primary_button_url')
                                    ->label('Primary Button URL')
                                    ->default('https://wa.me/6281234567890')
                                    ->url()
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('secondary_button_text')
                                    ->label('Secondary Button Text')
                                    ->default('Kirim Pertanyaan')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('secondary_button_url')
                                    ->label('Secondary Button URL')
                                    ->default('/contact')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('primary_button_text')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
            'index' => Pages\ManageMachineCta::route('/'),
            'create' => Pages\CreateMachineCta::route('/create'),
            'edit' => Pages\EditMachineCta::route('/{record}/edit'),
        ];
    }
}
