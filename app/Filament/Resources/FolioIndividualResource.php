<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FolioIndividualResource\Pages;
use App\Models\FolioIndividual;
use App\Models\FolioGlobal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FolioIndividualResource extends Resource
{
    protected static ?string $model = FolioIndividual::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Folio Individual';
    protected static ?string $pluralLabel = 'Folios Individuales';
    protected static ?string $slug = 'folios-individuales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Crear Folio Global')
                    ->schema([
                        Forms\Components\TextInput::make('numero_folio_individual')
                            ->label('Número de Folio Individual')
                            ->required(),

                        // Campo de Selección para Folio Global
                        Forms\Components\Select::make('id_folio_global')
                            ->label('Número de Folio Global al que Pertenece')
                            ->options(FolioGlobal::pluck('codigo_catastral', 'id_folio_global')) // Usar `codigo_catastral` como identificador
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Buscar el folio global y obtener `nombre_urb_anterior` si existe
                                $folioGlobal = FolioGlobal::find($state);
                                if ($folioGlobal && $folioGlobal->nombre_urb_anterior) {
                                    $set('nombre_urb_actual', $folioGlobal->nombre_urb_anterior);
                                } else {
                                    // Si no se encuentra o no tiene `nombre_urb_anterior`, limpiar el campo
                                    $set('nombre_urb_actual', null);
                                }
                            }),

                        // Campo que muestra el nombre de la urbanización desde `nombre_urb_anterior` de `FolioGlobal`
                        Forms\Components\TextInput::make('nombre_urb_actual')
                            ->label('Nombre de la Urbanización')
                            ->disabled()
                            ->placeholder('Seleccione un Folio Global para autocompletar'),

                        Forms\Components\Radio::make('codigo_catastral')
                            ->label('Código Catastral')
                            ->options([
                                'no' => 'No',
                                'si' => 'Sí',
                            ])
                            ->inline()
                            ->reactive()
                            ->disabled(fn ($get) => !$get('id_folio_global')),

                        Forms\Components\TextInput::make('numero_catastro')
                            ->label('Número de Catastro')
                            ->hidden(fn ($get) => $get('codigo_catastral') !== 'si' || !$get('id_folio_global'))
                            ->placeholder('Ingrese el número de catastro'),

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
                            ->reactive()
                            ->disabled(fn ($get) => !$get('id_folio_global')),

                        Forms\Components\TextInput::make('otro_estado_folio')
                            ->label('Especificar Otro')
                            ->visible(fn ($get) => in_array('otro', $get('estado_folio') ?? []) && $get('id_folio_global'))
                            ->placeholder('Ingrese otro estado de folio'),

                        Forms\Components\Textarea::make('testimonio')
                            ->label('Testimonio')
                            ->disabled(fn ($get) => !$get('id_folio_global')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_folio_individual')
                    ->label('Número de Folio Individual'),

                Tables\Columns\TextColumn::make('id_folio_global')
                    ->label('Número de Folio Global al que Pertenece'),

                Tables\Columns\TextColumn::make('nombre_urb_actual')
                    ->label('Nombre de la Urbanización'),

                Tables\Columns\TextColumn::make('codigo_catastral')
                    ->label('Código Catastral'),

                Tables\Columns\TextColumn::make('estado_folio')
                    ->label('Estado Folio')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),

                Tables\Columns\TextColumn::make('testimonio')
                    ->label('Testimonio'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Aquí puedes definir relaciones si las tienes
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFolioIndividuals::route('/'),
            'create' => Pages\CreateFolioIndividual::route('/create'),
            'edit' => Pages\EditFolioIndividual::route('/{record}/edit'),
        ];
    }
}
