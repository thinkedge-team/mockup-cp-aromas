<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Forms\Components\ImageUpload;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-s-hand-raised';

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Partners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Partner Information')
                    ->description('Configure partner logo and website link')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Partner Name')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('e.g., Indomaret'),
                        ImageUpload::make('logo')
                            ->label('Partner Logo')
                            ->image()
                            ->directory('partners/logos')
                            ->maxSize(2048)
                            ->helperText('Upload partner logo (recommended size: 200x100px)'),
                        Forms\Components\TextInput::make('icon')
                            ->label('Bootstrap Icon (Alternative)')
                            ->placeholder('e.g., bi-shop')
                            ->maxLength(50)
                            ->helperText('Use Bootstrap icon if no logo uploaded'),
                        Forms\Components\TextInput::make('url')
                            ->label('Partner Website URL')
                            ->placeholder('https://www.indomaret.co.id')
                            ->maxLength(255)
                            ->url()
                            ->helperText('If filled, the logo will be clickable and open this URL'),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
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
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
