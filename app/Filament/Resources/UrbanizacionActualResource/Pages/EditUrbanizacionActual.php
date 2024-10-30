<?php

namespace App\Filament\Resources\UrbanizacionActualResource\Pages;

use App\Filament\Resources\UrbanizacionActualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUrbanizacionActual extends EditRecord
{
    protected static string $resource = UrbanizacionActualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
