<?php

namespace App\Filament\Resources\NotarioResource\Pages;

use App\Filament\Resources\NotarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotarios extends ListRecords
{
    protected static string $resource = NotarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
