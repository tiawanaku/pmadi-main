<?php

namespace App\Filament\Resources\FolioGlobalResource\Pages;

use App\Filament\Resources\FolioGlobalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFolioGlobal extends EditRecord
{
    protected static string $resource = FolioGlobalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}