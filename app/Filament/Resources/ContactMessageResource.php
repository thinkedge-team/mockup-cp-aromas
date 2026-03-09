<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Pesan Masuk';
    protected static ?string $navigationGroup = 'Hubungi Kami';
    protected static ?int $navigationSort = 7;
    protected static ?string $modelLabel = 'Pesan';
    protected static ?string $pluralModelLabel = 'Pesan Masuk';

    /**
     * Badge merah di nav jika ada pesan baru
     */
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    // ── FORM (hanya untuk edit follow-up, data utama readonly) ─────────────
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Identitas Pengirim')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->disabled(),
                    Forms\Components\TextInput::make('company')
                        ->label('Perusahaan')
                        ->disabled(),
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->disabled(),
                    Forms\Components\TextInput::make('phone')
                        ->label('No. WhatsApp')
                        ->disabled(),
                    Forms\Components\TextInput::make('city')
                        ->label('Kota / Provinsi')
                        ->disabled(),
                    Forms\Components\TextInput::make('subject')
                        ->label('Topik / Subjek')
                        ->disabled(),
                ]),

            Forms\Components\Section::make('Detail Pesan')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('product')
                        ->label('Produk Diminati')
                        ->disabled(),
                    Forms\Components\TextInput::make('volume')
                        ->label('Estimasi Volume / Bulan')
                        ->disabled(),
                    Forms\Components\Textarea::make('message')
                        ->label('Isi Pesan')
                        ->rows(5)
                        ->disabled()
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Lampiran')
                ->icon('heroicon-o-paper-clip')
                ->schema([
                    Forms\Components\Placeholder::make('attachments_display')
                        ->label('File Lampiran')
                        ->content(function ($record) {
                            if (empty($record?->attachments)) {
                                return 'Tidak ada lampiran.';
                            }
                            $links = collect($record->attachments)->map(function ($att) {
                                $url  = asset('storage/' . $att['path']);
                                $name = e($att['original_name']);
                                $size = number_format($att['size'] / 1024, 1) . ' KB';
                                return "<a href=\"{$url}\" target=\"_blank\" class=\"text-primary-600 underline\">{$name}</a> <span class=\"text-gray-400 text-xs\">({$size})</span>";
                            })->join('<br/>');
                            return new \Illuminate\Support\HtmlString($links);
                        }),
                ])
                ->collapsed()
                ->visible(fn ($record) => !empty($record?->attachments)),

            Forms\Components\Section::make('Follow-up Internal')
                ->icon('heroicon-o-clipboard-document-check')
                ->description('Bagian ini hanya terlihat oleh tim internal. Gunakan untuk mencatat tindak lanjut.')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'new'         => 'Baru',
                            'in_progress' => 'Diproses',
                            'done'        => 'Selesai',
                            'rejected'    => 'Ditolak',
                        ])
                        ->native(false)
                        ->required(),

                    Forms\Components\TextInput::make('followed_up_by')
                        ->label('Ditangani Oleh')
                        ->placeholder('Nama anggota tim'),

                    Forms\Components\DateTimePicker::make('followed_up_at')
                        ->label('Waktu Ditangani')
                        ->displayFormat('d M Y, H:i')
                        ->native(false),

                    Forms\Components\Textarea::make('notes')
                        ->label('Catatan Internal')
                        ->placeholder('Tuliskan catatan tindak lanjut, hasil komunikasi, dll.')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    // ── TABLE ───────────────────────────────────────────────────────────────
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Topik')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pemesanan Produk'      => 'success',
                        'Kemitraan / Distribusi' => 'warning',
                        'Pengaduan / Saran'     => 'danger',
                        default                  => 'info',
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('phone')
                    ->label('WhatsApp')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('product')
                    ->label('Produk')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => ContactMessage::$statusLabels[$state] ?? $state)
                    ->colors([
                        'info'    => 'new',
                        'warning' => 'in_progress',
                        'success' => 'done',
                        'danger'  => 'rejected',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('followed_up_by')
                    ->label('Ditangani Oleh')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('followed_up_at')
                    ->label('Waktu Tindak Lanjut')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'new'         => 'Baru',
                        'in_progress' => 'Diproses',
                        'done'        => 'Selesai',
                        'rejected'    => 'Ditolak',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal')
                            ->displayFormat('d/m/Y')
                            ->native(false),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal')
                            ->displayFormat('d/m/Y')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'],  fn ($q, $v) => $q->whereDate('created_at', '>=', $v))
                            ->when($data['until'], fn ($q, $v) => $q->whereDate('created_at', '<=', $v));
                    })
                    ->label('Rentang Tanggal'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn (ContactMessage $record) => static::getUrl('view', ['record' => $record])),

                Tables\Actions\EditAction::make()
                    ->label('Follow-up')
                    ->icon('heroicon-o-clipboard-document-check'),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_done')
                        ->label('Tandai Selesai')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['status' => 'done']))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('mark_in_progress')
                        ->label('Tandai Diproses')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->action(fn ($records) => $records->each->update(['status' => 'in_progress']))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }

    // ── INFOLIST (halaman View, readonly) ───────────────────────────────────
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Infolists\Components\Section::make('Identitas Pengirim')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    Infolists\Components\TextEntry::make('name')->label('Nama Lengkap'),
                    Infolists\Components\TextEntry::make('company')->label('Perusahaan')->placeholder('—'),
                    Infolists\Components\TextEntry::make('email')->label('Email')
                        ->url(fn ($record) => 'mailto:' . $record->email),
                    Infolists\Components\TextEntry::make('phone')->label('No. WhatsApp')
                        ->url(fn ($record) => 'https://wa.me/' . preg_replace('/\D/', '', $record->phone)),
                    Infolists\Components\TextEntry::make('city')->label('Kota / Provinsi'),
                    Infolists\Components\TextEntry::make('subject')->label('Topik')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Pemesanan Produk'      => 'success',
                            'Kemitraan / Distribusi' => 'warning',
                            'Pengaduan / Saran'     => 'danger',
                            default                  => 'info',
                        }),
                ]),

            Infolists\Components\Section::make('Detail Pesan')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->columns(2)
                ->schema([
                    Infolists\Components\TextEntry::make('product')->label('Produk Diminati')->placeholder('—'),
                    Infolists\Components\TextEntry::make('volume')->label('Estimasi Volume / Bulan')->placeholder('—'),
                    Infolists\Components\TextEntry::make('message')->label('Isi Pesan')
                        ->columnSpanFull()
                        ->html(),
                ]),

            Infolists\Components\Section::make('Lampiran')
                ->icon('heroicon-o-paper-clip')
                ->schema([
                    Infolists\Components\TextEntry::make('attachments_html')
                        ->label('File Lampiran')
                        ->getStateUsing(function ($record): string {
                            if (empty($record->attachments)) {
                                return 'Tidak ada lampiran.';
                            }
                            return collect($record->attachments)
                                ->map(function ($att) {
                                    $url  = asset('storage/' . ($att['path'] ?? ''));
                                    $name = e($att['original_name'] ?? 'file');
                                    $size = isset($att['size'])
                                        ? number_format((int) $att['size'] / 1024, 1) . ' KB'
                                        : '';
                                    return "<a href=\"{$url}\" target=\"_blank\" "
                                         . "style=\"color:#2563eb;text-decoration:underline;font-weight:500;\">{$name}</a>"
                                         . ($size ? " <span style=\"color:#9ca3af;font-size:.8rem;\">({$size})</span>" : '');
                                })
                                ->join('<br>');
                        })
                        ->html()
                        ->columnSpanFull(),
                ])
                ->collapsed()
                ->visible(fn ($record) => !empty($record?->attachments)),

            Infolists\Components\Section::make('Status Follow-up')
                ->icon('heroicon-o-clipboard-document-check')
                ->columns(2)
                ->schema([
                    Infolists\Components\TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->formatStateUsing(fn (string $state): string => ContactMessage::$statusLabels[$state] ?? $state)
                        ->color(fn (string $state): string => ContactMessage::$statusColors[$state] ?? 'gray'),

                    Infolists\Components\TextEntry::make('followed_up_by')
                        ->label('Ditangani Oleh')
                        ->placeholder('—'),

                    Infolists\Components\TextEntry::make('followed_up_at')
                        ->label('Waktu Ditangani')
                        ->dateTime('d M Y, H:i')
                        ->placeholder('—'),

                    Infolists\Components\TextEntry::make('notes')
                        ->label('Catatan Internal')
                        ->columnSpanFull()
                        ->placeholder('Belum ada catatan.'),
                ]),

            Infolists\Components\Section::make('Informasi Sistem')
                ->icon('heroicon-o-clock')
                ->columns(2)
                ->collapsed()
                ->schema([
                    Infolists\Components\TextEntry::make('created_at')
                        ->label('Diterima')
                        ->dateTime('d M Y, H:i'),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label('Terakhir Diperbarui')
                        ->dateTime('d M Y, H:i'),
                ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListContactMessages::route('/'),
            'view'   => Pages\ViewContactMessage::route('/{record}'),
            'edit'   => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
