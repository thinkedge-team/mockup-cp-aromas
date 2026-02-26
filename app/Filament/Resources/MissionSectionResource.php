<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MissionSectionResource\Pages;
use App\Models\MissionSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MissionSectionResource extends Resource
{
    protected static ?string $model = MissionSection::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-text';

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Mission Section';

    protected static ?string $recordTitleAttribute = 'mission_text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Mission Content')
                    ->description('Configure the mission section text and badges')
                    ->schema([
                        Forms\Components\Textarea::make('mission_text')
                            ->label('Mission Statement')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->default('Di AROMAS, kami berkomitmen menghadirkan minyak goreng premium dengan kualitas Terjamin dan proses produksi berkelanjutan.')
                            ->helperText('First part of the mission statement'),
                        Forms\Components\TextInput::make('highlight_text')
                            ->label('Highlight Text')
                            ->default('minyak goreng premium')
                            ->maxLength(100)
                            ->helperText('Text to highlight in the mission'),
                        Forms\Components\TextInput::make('eco_badge_text')
                            ->label('Eco Badge Text')
                            ->default('Terjamin')
                            ->maxLength(50)
                            ->helperText('Text shown in the green badge'),
                        Forms\Components\Textarea::make('mission_text_continued')
                            ->label('Mission Statement (Continued)')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->default('Dengan dedikasi terhadap kesehatan konsumen dan kelestarian lingkungan, kami bertujuan menjadi produsen minyak goreng terpercaya di Indonesia.')
                            ->helperText('Second part of the mission statement'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mission_text')
                    ->label('Mission Text')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('highlight_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('eco_badge_text')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([])
            ->bulkActions([])
            ->filters([])
            ->paginated(false);
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
            'index' => Pages\ManageMissionSection::route('/'),
            'create' => Pages\CreateMissionSection::route('/create'),
            'edit' => Pages\EditMissionSection::route('/{record}/edit'),
        ];
    }
}
