<?php

namespace App\Filament\Resources\TestimonioResource\Pages;

use App\Filament\Resources\TestimonioResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditTestimonios extends EditRecord
{
    protected static string $resource = TestimonioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
