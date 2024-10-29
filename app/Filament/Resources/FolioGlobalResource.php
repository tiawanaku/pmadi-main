<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FolioGlobalResource\Pages;
use App\Filament\Resources\FolioGlobalResource\RelationManagers;
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
                    Forms\Components\TextInput::make('nombre_folio_global')
                        ->label('Nombre del Folio Global')
                        ->required(),

                    Forms\Components\Select::make('nombre_urbanizacion')
                        ->label('Nombre de la Urbanización')
                        ->options([
                            // Opciones predefinidas o conexión a un modelo
                        ])
                        ->required(),

                    Forms\Components\TextInput::make('nombre_anterior')
                        ->label('Nombre Anterior'),

                    Forms\Components\TextInput::make('superficie')
                        ->label('Superficie'),

                    Forms\Components\TextInput::make('codigo_catastral')
                        ->label('Código Catastral'),

                    Forms\Components\Toggle::make('web')
                        ->label('Web')
                        ->onColor('success')
                        ->offColor('danger')
                        ->inlineLabel(true),

                    Forms\Components\Radio::make('estado_folio')
                        ->label('Estado Folio')
                        ->options([
                            'si' => 'Sí es otro',
                            'no' => 'No es otro',
                        ])
                        ->inline(),

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

                Tables\Columns\BooleanColumn::make('web')
                    ->label('Web'),

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
