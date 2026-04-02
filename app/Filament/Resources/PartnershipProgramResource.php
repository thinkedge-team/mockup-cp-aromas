<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipProgramResource\Pages;
use App\Models\PartnershipProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipProgramResource extends Resource
{
    protected static ?string $model = PartnershipProgram::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Program Kemitraan';
    protected static ?string $navigationGroup = 'Partnership';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Program';
    protected static ?string $pluralModelLabel = 'Program Kemitraan';

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ── IDENTITAS PROGRAM ──────────────────────────────────
            Forms\Components\Section::make('Identitas Program')
                ->description('Informasi dasar dan tampilan identitas program kemitraan')
                ->icon('heroicon-o-identification')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug / ID Program')
                        ->helperText('Jangan ubah: franchise | distributor | agen | maklon | implan')
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama Program')
                        ->placeholder('Franchise')
                        ->required(),

                    Forms\Components\TextInput::make('icon')
                        ->label('Icon (Bootstrap Icon)')
                        ->helperText('Tanpa "bi-", contoh: award-fill. Cek: https://icons.getbootstrap.com')
                        ->placeholder('award-fill')
                        ->required(),

                    Forms\Components\TextInput::make('color_hex')
                        ->label('Warna Hex Program')
                        ->helperText('Warna utama untuk chip & tab (Hex, contoh: #d4a017)')
                        ->placeholder('#d4a017')
                        ->required(),

                    Forms\Components\TextInput::make('image_url')
                        ->label('URL Gambar Header Panel')
                        ->placeholder('https://images.unsplash.com/...')
                        ->url()
                        ->columnSpanFull(),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                    ])->columnSpanFull(),
                ]),

            // ── HEADER PANEL ──────────────────────────────────────
            Forms\Components\Section::make('Header Panel')
                ->description('Teks yang tampil di banner atas panel program')
                ->icon('heroicon-o-photo')
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make('badge_label')
                        ->label('Badge Label')
                        ->placeholder('Franchise')
                        ->required(),

                    Forms\Components\TextInput::make('panel_title')
                        ->label('Judul Panel')
                        ->placeholder('Program Franchise AROMAS')
                        ->required(),

                    Forms\Components\Textarea::make('panel_subtitle')
                        ->label('Subtitle Panel')
                        ->rows(2),
                ]),

            // ── INFO GRID (6 ITEM) ────────────────────────────────
            Forms\Components\Section::make('Info Grid')
                ->description('6 kotak info yang tampil di bawah banner (investasi, ROI, dll.)')
                ->icon('heroicon-o-squares-plus')
                ->schema([
                    Forms\Components\Repeater::make('info_items')
                        ->label(false)
                        ->schema([
                            Forms\Components\Grid::make(4)->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon')
                                    ->placeholder('cash-coin')
                                    ->helperText('Bootstrap icon tanpa bi-'),

                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->placeholder('Investasi Awal'),

                                Forms\Components\TextInput::make('value')
                                    ->label('Nilai')
                                    ->placeholder('Rp 50 – 150 Jt'),

                                Forms\Components\TextInput::make('note')
                                    ->label('Catatan')
                                    ->placeholder('Bergantung ukuran gerai'),
                            ]),
                            Forms\Components\Select::make('color_class')
                                ->label('Warna Kotak')
                                ->options([
                                    'clr-gold'   => 'Emas (Franchise)',
                                    'clr-green'  => 'Hijau (Distributor)',
                                    'clr-blue'   => 'Biru (Agen)',
                                    'clr-purple' => 'Ungu (Maklon)',
                                    'clr-red'    => 'Merah (Implan)',
                                ])
                                ->required(),
                        ])
                        ->maxItems(6)
                        ->minItems(1)
                        ->addActionLabel('+ Tambah Item Info')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                ]),

            // ── DAFTAR KEUNTUNGAN ─────────────────────────────────
            Forms\Components\Section::make('Keuntungan Bergabung')
                ->description('Daftar bullet poin kelebihan program ini')
                ->icon('heroicon-o-check-circle')
                ->schema([
                    Forms\Components\Repeater::make('benefits')
                        ->label(false)
                        ->schema([
                            Forms\Components\TextInput::make('text')
                                ->label('Kelebihan')
                                ->placeholder('Hak eksklusif menggunakan merek AROMAS di wilayah Anda')
                                ->required(),
                        ])
                        ->addActionLabel('+ Tambah Keuntungan')
                        ->reorderable()
                        ->itemLabel(fn (array $state): ?string => isset($state['text']) ? \Str::limit($state['text'], 50) : null),
                ]),

            // ── PERSYARATAN ───────────────────────────────────────
            Forms\Components\Section::make('Persyaratan Mitra')
                ->description('Daftar syarat yang harus dipenuhi calon mitra')
                ->icon('heroicon-o-clipboard-document-check')
                ->schema([
                    Forms\Components\Repeater::make('requirements')
                        ->label(false)
                        ->schema([
                            Forms\Components\TextInput::make('text')
                                ->label('Persyaratan')
                                ->placeholder('WNI usia min. 21 tahun / Badan usaha legal')
                                ->required(),
                        ])
                        ->addActionLabel('+ Tambah Persyaratan')
                        ->reorderable()
                        ->itemLabel(fn (array $state): ?string => isset($state['text']) ? \Str::limit($state['text'], 50) : null),
                ]),

            // ── STEP-BY-STEP ──────────────────────────────────────
            Forms\Components\Section::make('Langkah-langkah Pendaftaran')
                ->description('Ditampilkan sebagai flow steps horizontal di bagian bawah panel')
                ->icon('heroicon-o-arrow-right-circle')
                ->schema([
                    Forms\Components\Repeater::make('steps')
                        ->label(false)
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Nama Langkah')
                                    ->placeholder('Pengajuan Online')
                                    ->required(),

                                Forms\Components\TextInput::make('sub')
                                    ->label('Keterangan Singkat')
                                    ->placeholder('Isi formulir pendaftaran'),
                            ]),
                        ])
                        ->maxItems(6)
                        ->addActionLabel('+ Tambah Langkah')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                ]),

            // ── CTA PANEL ─────────────────────────────────────────
            Forms\Components\Section::make('CTA Panel Program')
                ->description('Tombol ajakan bertindak di bagian bawah panel ini')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('cta_title')
                        ->label('Judul CTA')
                        ->placeholder('Tertarik Membuka Franchise AROMAS?')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('cta_subtitle')
                        ->label('Sub-teks CTA')
                        ->placeholder('Konsultasikan kebutuhan Anda secara gratis.')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('cta_wa_text')
                        ->label('Pre-fill Pesan WhatsApp')
                        ->placeholder('Halo, saya tertarik program Franchise AROMAS')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('cta_btn_wa_label')
                        ->label('Label Tombol WA')
                        ->placeholder('Konsultasi Gratis')
                        ->default('Konsultasi Gratis'),

                    Forms\Components\TextInput::make('cta_btn_form_label')
                        ->label('Label Tombol Formulir')
                        ->placeholder('Daftar Sekarang')
                        ->default('Daftar Sekarang'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Program')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->badge(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->since(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([Tables\Actions\EditAction::make()])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartnershipPrograms::route('/'),
            'edit'  => Pages\EditPartnershipProgram::route('/{record}/edit'),
        ];
    }
}
