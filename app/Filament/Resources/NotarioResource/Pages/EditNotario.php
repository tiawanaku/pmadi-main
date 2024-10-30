<?php

namespace App\Filament\Resources\NotarioResource\Pages;

use App\Filament\Resources\NotarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotario extends EditRecord
{
    protected static string $resource = NotarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
