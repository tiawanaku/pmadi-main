<?php

namespace App\Filament\Resources\TestimonioResource\Pages;

use App\Filament\Resources\TestimonioResource;
use App\Models\Notario;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;

class CreateTestimonios extends CreateRecord
{
    protected static string $resource = TestimonioResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Agregar Nuevo Notario')
                ->label('Agregar Nuevo Notario')
                ->modalHeading('Nuevo Notario')
                ->modalWidth('lg')
                ->form([
                    TextInput::make('nombre_completo')
                        ->label('Nombre del Notario')
                        ->required(),
                    TextInput::make('nro_notaria')
                        ->label('Número de Notaría')
                        ->required(),
                ])
                ->action(function (array $data) {
                    Notario::create([
                        'nombre_completo' => $data['nombre_completo'],
                        'nro_notaria' => $data['nro_notaria'],
                    ]);
                }),
        ];
    }
}
