<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FolioIndividualResource\Pages;
use App\Models\FolioIndividual;
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
                Forms\Components\Section::make('Crear Folio Individual')
                    ->schema([
                        Forms\Components\TextInput::make('numero_folio')
                            ->label('No. Folio Individual')
                            ->required(),

                        Forms\Components\TextInput::make('nombre_urbanizacion')
                            ->label('Nombre Urbanización')
                            ->required(),

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

                        Forms\Components\Select::make('testimonio_id')
                            ->label('Testimonio')
                            ->relationship('testimonio', 'nro_testimonio')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Textarea::make('observacion')
                    ->label('Observación')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_folio')
                    ->label('No. Folio Individual'),
                Tables\Columns\TextColumn::make('nombre_urbanizacion')
                    ->label('Nombre Urbanización'),
                Tables\Columns\TextColumn::make('codigo_catastral')
                    ->label('Código Catastral'),
                Tables\Columns\TextColumn::make('estado_folio')
                    ->label('Estado Folio'),
                Tables\Columns\TextColumn::make('testimonio.nro_testimonio')
                    ->label('Testimonio'),
            ])
            ->filters([]);
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
