<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BenefitResource\Pages;
use App\Filament\Resources\BenefitResource\RelationManagers;
use App\Models\Benefit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BenefitResource extends Resource
{
    protected static ?string $model = Benefit::class;

    protected static ?string $navigationIcon = 'heroicon-s-heart';

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Benefits';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('icon')
                    ->label('Bootstrap Icon')
                    ->required()
                    ->placeholder('bi-heart-pulse')
                    ->helperText('Masukkan nama icon dari Bootstrap Icons (format: bi-nama-icon). Cari icon di: https://icons.getbootstrap.com/')
                    ->rules([
                        'required',
                        'regex:/^bi-[a-z0-9-]+$/',
                    ])
                    ->validationMessages([
                        'regex' => 'Format icon harus: bi-nama-icon (contoh: bi-heart-pulse, bi-fire, bi-star). Gunakan huruf kecil dan tanda strip (-) saja.',
                    ])
                    ->suffixIcon('heroicon-m-information-circle')
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('browse_icons')
                            ->label('Browse Icons')
                            ->icon('heroicon-m-magnifying-glass')
                            ->url('https://icons.getbootstrap.com/', shouldOpenInNewTab: true)
                            ->color('primary')
                    ),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->formatStateUsing(fn (string $state): string => 
                        '<i class="bi ' . $state . '" style="font-size: 1.5rem; margin-right: 8px;"></i>' . 
                        '<span style="font-family: monospace; font-size: 0.875rem;">' . $state . '</span>'
                    )
                    ->html()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBenefits::route('/'),
            'create' => Pages\CreateBenefit::route('/create'),
            'edit' => Pages\EditBenefit::route('/{record}/edit'),
        ];
    }
}
