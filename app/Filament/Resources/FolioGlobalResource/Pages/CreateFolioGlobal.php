<?php

namespace App\Filament\Resources\FolioGlobalResource\Pages;

use App\Filament\Resources\FolioGlobalResource;
use App\Models\UrbanizacionActual;
use App\Models\Distrito;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;

class CreateFolioGlobal extends CreateRecord
{
    protected static string $resource = FolioGlobalResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Agregar Nueva Urbanización')
                ->label('Agregar Nueva Urbanización')
                ->modalHeading('Nueva Urbanización')
                ->modalWidth('lg')
                ->form([
                    TextInput::make('nombre_urb_actual')
                        ->label('Nombre de la Urbanización')
                        ->required(),

                    Select::make('id_distrito')
                        ->label('Distrito')
                        ->options(Distrito::all()->pluck('nombre_distrito', 'id_distrito'))
                        ->searchable()
                        ->required(),
                ])
                ->action(function (array $data) {
                    UrbanizacionActual::create([
                        'nombre_urb_actual' => strtoupper(trim($data['nombre_urb_actual'])),
                        'id_distrito' => $data['id_distrito'],
                    ]);
                })
                ->successNotificationTitle('Urbanización creada correctamente'),
        ];
    }
}
