<?php

namespace App\Filament\Resources\FolioGlobalResource\Pages;

use App\Filament\Resources\FolioGlobalResource;
use App\Models\UrbanizacionActual;
use App\Models\Distrito;
use App\Models\Folio;
use App\Models\FolioGlobal;
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

    protected function handleRecordCreation(array $data): FolioGlobal
    {
        // Primero, crea el folio en la tabla 'folio'
        $folio = Folio::create([
            'nro_folio' => $data['nro_folio'], // Usa el número de folio ingresado
            // Puedes agregar más campos a 'folio' si es necesario
        ]);

        // Luego, crea el registro en 'folio_global' y enlaza con el 'folio' recién creado
        $folioGlobal = FolioGlobal::create(array_merge($data, [
            'id_folio' => $folio->id, // Relaciona 'folio_global' con el 'folio' recién creado
        ]));

        return $folioGlobal;
    }


}
