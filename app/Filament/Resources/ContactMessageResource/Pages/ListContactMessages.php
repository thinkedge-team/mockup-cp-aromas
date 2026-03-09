<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(fn () => \App\Models\ContactMessage::count()),

            'new' => Tab::make('Baru')
                ->badge(fn () => \App\Models\ContactMessage::where('status', 'new')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'new')),

            'in_progress' => Tab::make('Diproses')
                ->badge(fn () => \App\Models\ContactMessage::where('status', 'in_progress')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in_progress')),

            'done' => Tab::make('Selesai')
                ->badge(fn () => \App\Models\ContactMessage::where('status', 'done')->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'done')),

            'rejected' => Tab::make('Ditolak')
                ->badge(fn () => \App\Models\ContactMessage::where('status', 'rejected')->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
        ];
    }
}
