<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FolioGlobalResource\Pages;
use App\Models\FolioGlobal;
use App\Models\UrbanizacionActual;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FolioGlobalResource extends Resource
{
    protected static ?string $model = FolioGlobal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Crear Folio Global')
                ->schema([
                    // campo para seleccionar un folio existente
                    Forms\Components\TextInput::make('nro_folio')
                    ->label('Número de Folio')
                    ->required()
                    ->placeholder('Ingrese el número de folio para crear uno nuevo'),


                    Forms\Components\Select::make('id_urb_actual')
                    ->label('Nombre de la Urbanización')
                    ->options(function () {
                        return UrbanizacionActual::all()->pluck('nombre_urb_actual', 'id_urb_actual');
                    })
                    ->searchable()
                    ->placeholder('Seleccione o busque la urbanización')
                    ->required()
                    ->reactive(),


                    // otros campos en su formulario
                    Forms\Components\TextInput::make('nombre_urb_anterior')
                        ->label('Nombre Anterior'),

                    Forms\Components\TextInput::make('superficie_restante')
                        ->label('Superficie')
                        ->numeric(),

                        Forms\Components\TextInput::make('cod_catastral')
                        ->label('codigo catastral')
                        ->required()
                        ->placeholder('Ingrese el número del codigo catastral'),

                        Forms\Components\Radio::make('gravamen')
                        ->label('Gravamen')
                        ->options([
                            'no' => 'No',
                            'si' => 'Sí',
                        ])
                        ->inline()
                        ->required() // Añade validación de campo requerido
                        ->reactive(),

                        Forms\Components\CheckboxList::make('estado_folio')
                            ->label('Estado Folio')
                            ->options([
                                'reposicion' => 'Reposición',
                                'actualizacion' => 'Actualización',
                                'cambio_matricula' => 'Cambio a matrícula',
                                'cambio_razon_social' => 'Cambio de razón social',
                                'cambio_jurisdiccion' => 'Cambio de jurisdicción',
                                'solicitud_tenes_perencia' => 'Solicitud de Tenes Perencia',
                                'otro' => 'Otro',
                            ])
                            ->reactive(),

                        Forms\Components\TextInput::make('otro_estado_folio')
                            ->label('Especificar Otro')
                            ->visible(fn($get) => in_array('otro', $get('estado_folio') ?? []))
                            ->placeholder('Ingrese otro estado de folio'),

                        Forms\Components\Textarea::make('testimonio')
                            ->label('Testimonio'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('folio.nro_folio')
                ->label('Número de Folio Global'),

                Tables\Columns\TextColumn::make('id_urb_actual')
                    ->label('Nombre de la Urbanización'),

                Tables\Columns\TextColumn::make('nombre_urb_anterior')
                    ->label('Nombre Anterior'),

                Tables\Columns\TextColumn::make('superficie_restante')
                    ->label('Superficie'),

                Tables\Columns\TextColumn::make('cod_catastral')
                    ->label('Código Catastral'),

                    Tables\Columns\TextColumn::make('gravamen')
                    ->label('gravamen'),

                Tables\Columns\TextColumn::make('estado_folio')
                    ->label('Estado Folio'),

                Tables\Columns\TextColumn::make('testimonio')
                    ->label('Testimonio'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFolioGlobals::route('/'),
            'create' => Pages\CreateFolioGlobal::route('/create'),
            'edit' => Pages\EditFolioGlobal::route('/{record}/edit'),
        ];
    }

    public static function afterCreate($record)
    { // crea un nuevo `folio` usando `nro_folio`
        $folio = \App\Models\Folio::create([
            'nro_folio' => $record->nro_folio, // usa el número de folio ingresado en el formulario
        ]);

        // actualiza `folio_global` para que `id_folio` apunte al `folio` recién creado
        $record->update(['id_folio' => $folio->id]);
    }
}
