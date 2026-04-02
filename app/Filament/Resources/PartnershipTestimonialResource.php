<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipTestimonialResource\Pages;
use App\Models\PartnershipTestimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipTestimonialResource extends Resource
{
    protected static ?string $model = PartnershipTestimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Testimoni Mitra';
    protected static ?string $navigationGroup = 'Partnership';
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'Testimoni';
    protected static ?string $pluralModelLabel = 'Testimoni Mitra';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identitas Pemberi Testimoni')
                ->icon('heroicon-o-user-circle')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->placeholder('Budi Santoso')
                        ->required(),

                    Forms\Components\TextInput::make('role')
                        ->label('Jabatan / Perusahaan')
                        ->placeholder('Gerai AROMAS Bekasi'),

                    Forms\Components\Select::make('program_type')
                        ->label('Tipe Program')
                        ->options([
                            'franchise'   => '🏅 Franchise',
                            'distributor' => '🚚 Distributor',
                            'agen'        => '🏪 Agen / Reseller',
                            'maklon'      => '⚙️ Maklon',
                            'implan'      => '🏢 Implan Korporasi',
                        ])
                        ->required(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Forms\Components\FileUpload::make('avatar_url')
                        ->label('Foto Profil')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['1:1'])
                        ->disk('public')
                        ->directory('testimonials/avatars')
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Upload foto profil mitra (disarankan ukuran persegi, maks. 2MB)')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Kutipan Testimoni')
                ->icon('heroicon-o-chat-bubble-oval-left')
                ->schema([
                    Forms\Components\Textarea::make('text')
                        ->label('Isi Testimoni')
                        ->rows(4)
                        ->placeholder('Bergabung sebagai franchisee AROMAS adalah keputusan terbaik...')
                        ->required(),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Tampilkan')
                        ->default(true)
                        ->inline(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?background=228b22&color=fff&name=M'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Jabatan')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('program_type')
                    ->label('Program')
                    ->colors([
                        'warning' => 'franchise',
                        'success' => 'distributor',
                        'info'    => 'agen',
                        'purple'  => 'maklon',
                        'danger'  => 'implan',
                    ])
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
                Tables\Filters\SelectFilter::make('program_type')
                    ->label('Tipe Program')
                    ->options([
                        'franchise'   => '🏅 Franchise',
                        'distributor' => '🚚 Distributor',
                        'agen'        => '🏪 Agen / Reseller',
                        'maklon'      => '⚙️ Maklon',
                        'implan'      => '🏢 Implan Korporasi',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPartnershipTestimonials::route('/'),
            'create' => Pages\CreatePartnershipTestimonial::route('/create'),
            'edit'   => Pages\EditPartnershipTestimonial::route('/{record}/edit'),
        ];
    }
}
