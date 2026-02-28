<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipFaqResource\Pages;
use App\Models\PartnershipFaq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipFaqResource extends Resource
{
    protected static ?string $model = PartnershipFaq::class;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'FAQ Kemitraan';
    protected static ?string $navigationGroup = 'Kemitraan';
    protected static ?int $navigationSort = 7;
    protected static ?string $modelLabel = 'FAQ';
    protected static ?string $pluralModelLabel = 'FAQ Kemitraan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pertanyaan & Jawaban')
                ->icon('heroicon-o-question-mark-circle')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false),

                    Forms\Components\TextInput::make('question')
                        ->label('Pertanyaan')
                        ->placeholder('Apa perbedaan utama antara Distributor dan Agen/Reseller?')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('answer')
                        ->label('Jawaban')
                        ->rows(5)
                        ->required()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('question')->label('Pertanyaan')->limit(60)->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPartnershipFaqs::route('/'),
            'create' => Pages\CreatePartnershipFaq::route('/create'),
            'edit'   => Pages\EditPartnershipFaq::route('/{record}/edit'),
        ];
    }
}
