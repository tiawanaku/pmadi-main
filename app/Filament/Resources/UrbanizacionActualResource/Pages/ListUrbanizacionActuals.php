<?php

namespace App\Filament\Resources\UrbanizacionActualResource\Pages;

use App\Filament\Resources\UrbanizacionActualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUrbanizacionActuals extends ListRecords
{
    protected static string $resource = UrbanizacionActualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
