<?php

namespace App\Filament\Resources\FolioIndividualResource\Pages;

use App\Filament\Resources\FolioIndividualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFolioIndividual extends EditRecord
{
    protected static string $resource = FolioIndividualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
