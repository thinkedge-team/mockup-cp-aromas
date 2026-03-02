<?php

namespace App\Filament\Resources\PortfolioTestimonialResource\Pages;

use App\Filament\Resources\PortfolioTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioTestimonial extends EditRecord
{
    protected static string $resource = PortfolioTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
