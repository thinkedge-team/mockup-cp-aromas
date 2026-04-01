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
                            ->default('Di AROMAS, kami berkomitmen menghadirkan')
                            ->helperText('First part of the mission statement'),
                        
                        Forms\Components\TextInput::make('highlight_text')
                            ->label('Highlight Text')
                            ->default('minyak goreng premium')
                            ->maxLength(100)
                            ->helperText('Text to highlight in the mission (akan ditampilkan dengan warna highlight)'),
                        
                        Forms\Components\TextInput::make('middle_text')
                            ->label('Middle Text')
                            ->default('dengan kualitas')
                            ->maxLength(100)
                            ->helperText('Text between highlight and eco badge (contoh: "dengan kualitas")'),
                        
                        Forms\Components\TextInput::make('eco_badge_icon')
                            ->label('Eco Badge Icon')
                            ->default('bi-check-circle')
                            ->placeholder('bi-check-circle')
                            ->helperText('Masukkan nama icon dari Bootstrap Icons (format: bi-nama-icon). Cari icon di: https://icons.getbootstrap.com/')
                            ->rules([
                                'nullable',
                                'regex:/^bi-[a-z0-9-]+$/',
                            ])
                            ->validationMessages([
                                'regex' => 'Format icon harus: bi-nama-icon (contoh: bi-check-circle, bi-shield-check, bi-star-fill). Gunakan huruf kecil dan tanda strip (-) saja.',
                            ])
                            ->suffixIcon('heroicon-m-information-circle')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('browse_eco_icons')
                                    ->label('Browse Icons')
                                    ->icon('heroicon-m-magnifying-glass')
                                    ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                                    ->color('primary')
                            ),
                        
                        Forms\Components\TextInput::make('eco_badge_text')
                            ->label('Eco Badge Text')
                            ->default('Terjamin')
                            ->maxLength(50)
                            ->helperText('Text shown in the green badge'),
                        
                        Forms\Components\TextInput::make('transition_text')
                            ->label('Transition Text')
                            ->default('dan proses produksi berkelanjutan.')
                            ->maxLength(255)
                            ->helperText('Text after eco badge (contoh: "dan proses produksi berkelanjutan.")'),
                        
                        Forms\Components\Textarea::make('mission_text_continued')
                            ->label('Mission Statement (Continued)')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->default('Dengan dedikasi terhadap kesehatan konsumen dan kelestarian lingkungan, kami bertujuan menjadi produsen minyak goreng terpercaya di Indonesia.')
                            ->helperText('Second part of the mission statement'),
                        
                        Forms\Components\TextInput::make('leaf_icon')
                            ->label('Leaf Icon')
                            ->default('bi-award')
                            ->placeholder('bi-award')
                            ->helperText('Masukkan nama icon dari Bootstrap Icons (format: bi-nama-icon). Cari icon di: https://icons.getbootstrap.com/')
                            ->rules([
                                'nullable',
                                'regex:/^bi-[a-z0-9-]+$/',
                            ])
                            ->validationMessages([
                                'regex' => 'Format icon harus: bi-nama-icon (contoh: bi-award, bi-trophy, bi-star). Gunakan huruf kecil dan tanda strip (-) saja.',
                            ])
                            ->suffixIcon('heroicon-m-information-circle')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('browse_leaf_icons')
                                    ->label('Browse Icons')
                                    ->icon('heroicon-m-magnifying-glass')
                                    ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                                    ->color('primary')
                            ),
                        
                        Forms\Components\Textarea::make('final_text')
                            ->label('Final Text (Optional)')
                            ->rows(2)
                            ->columnSpanFull()
                            ->helperText('Optional text after the leaf icon'),
                        
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
                    ->label('Highlight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('eco_badge_icon')
                    ->label('Eco Icon')
                    ->formatStateUsing(fn (?string $state): string => 
                        $state 
                        ? '<i class="bi ' . $state . '" style="font-size: 1.2rem; margin-right: 6px;"></i>' . 
                          '<span style="font-family: monospace; font-size: 0.75rem; color: #666;">' . $state . '</span>'
                        : '-'
                    )
                    ->html(),
                Tables\Columns\TextColumn::make('eco_badge_text')
                    ->label('Badge Text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('leaf_icon')
                    ->label('Leaf Icon')
                    ->formatStateUsing(fn (?string $state): string => 
                        $state 
                        ? '<i class="bi ' . $state . '" style="font-size: 1.2rem; margin-right: 6px;"></i>' . 
                          '<span style="font-family: monospace; font-size: 0.75rem; color: #666;">' . $state . '</span>'
                        : '-'
                    )
                    ->html(),
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
