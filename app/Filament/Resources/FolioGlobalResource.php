<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FolioGlobalResource\Pages;
use App\Filament\Resources\FolioGlobalResource\RelationManagers;
use App\Models\Folio;
use App\Models\FolioGlobal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    Forms\Components\Select::make('id_urb_actual')
                    ->label('Nombre de la Urbanización')
                    ->options(\App\Models\UrbanizacionActual::all()->pluck('nombre_urb_actual', 'id_urb_actual'))
                    ->required(),
                    // Número de Folio Global
                    Forms\Components\TextInput::make('numero_folio_global')
                        ->label('Número de Folio Global')
                        ->required(),

                    // Nombre de la Urbanización
                    Forms\Components\Select::make('id_folio')
                    ->label('Nombre de la Urbanización')
                    ->options(Folio::all()->pluck('nombre', 'id_folio')) // Asegúrate de que 'id_folio' sea el segundo parámetro para enviar el ID
                    ->required(),
                    // Nombre Anterior
                    Forms\Components\TextInput::make('nombre_urb_anterior')
                        ->label('Nombre Anterior'),

                    // Superficie
                    Forms\Components\TextInput::make('superficie_restante')
                        ->label('Superficie')
                        ->numeric(),

                    // Código Catastral (con opción de sí/no) y forzar refresco con reactive()
                    Forms\Components\Radio::make('codigo_catastral')
                        ->label('Código Catastral')
                        ->options([
                            'no' => 'No',
                            'si' => 'Sí',
                        ])
                        ->inline()
                        ->reactive(), // Forzar el refresco del estado al cambiar el valor

                    // Campo adicional para Número de Catastro
                    Forms\Components\TextInput::make('numero_catastro')
                        ->label('Número de Catastro')
                        ->visible(fn ($get) => $get('codigo_catastral') === 'si')
                        ->placeholder('Ingrese el número de catastro'),

                    // Estado del Folio (con múltiples opciones de tipo checkbox)
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
                        ->reactive(), // Forzar actualización inmediata para que se detecte la selección de "Otro"

                    // Campo adicional para "Especificar Otro"
                    Forms\Components\TextInput::make('otro_estado_folio')
                        ->label('Especificar Otro')
                        ->visible(fn ($get) => in_array('otro', $get('estado_folio') ?? [])) // Solo visible si "Otro" está seleccionado
                        ->placeholder('Ingrese otro estado de folio'),

                    // Testimonio
                    Forms\Components\Textarea::make('testimonio')
                        ->label('Testimonio'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_folio_global')
                    ->label('Nombre del Folio Global'),

                Tables\Columns\TextColumn::make('nombre_urbanizacion')
                    ->label('Nombre de la Urbanización'),

                Tables\Columns\TextColumn::make('nombre_anterior')
                    ->label('Nombre Anterior'),

                Tables\Columns\TextColumn::make('superficie')
                    ->label('Superficie'),

                Tables\Columns\TextColumn::make('codigo_catastral')
                    ->label('Código Catastral'),

                Tables\Columns\TextColumn::make('estado_folio')
                    ->label('Estado Folio'),

                Tables\Columns\TextColumn::make('testimonio')
                    ->label('Testimonio'),
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
}
