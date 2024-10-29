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

                        Forms\Components\TextInput::make('codigo_catastral')
                            ->label('Código Catastral')
                            ->required(),

                        Forms\Components\Radio::make('codigo_catastro_existe')
                            ->label('¿Código Catastral?')
                            ->options([
                                'si' => 'Sí',
                                'no' => 'No',
                            ])
                            ->inline(),

                        Forms\Components\Select::make('estado_folio')
                            ->label('Estado Folio')
                            ->options([
                                'activo' => 'Activo',
                                'inactivo' => 'Inactivo',
                            ])
                            ->required(),

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
