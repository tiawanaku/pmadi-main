<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistritoResource\Pages;
use App\Filament\Resources\DistritoResource\RelationManagers;
use App\Models\Distrito;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use ArberMustafa\FilamentLocationPickrField\Forms\Components\LocationPickr;

class DistritoResource extends Resource
{
    protected static ?string $model = Distrito::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
         return $form
        ->schema([
            // Aquí se define el campo "nombre_distrito"
            Forms\Components\TextInput::make('nombre_distrito')
                ->required()
                ->label('Nombre del Distrito') // Etiqueta para el campo
                ->maxLength(255),

            // Agregar el campo de ubicación utilizando LocationPickr
            LocationPickr::make('location'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Aquí se define la columna para mostrar el nombre del distrito en la tabla
                Tables\Columns\TextColumn::make('nombre_distrito')
                    ->label('Nombre del Distrito')
                    ->sortable()
                    ->searchable(),
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

    public static function getPages(): array
    {

        return [
            'index' => Pages\ListDistritos::route('/'),
            'create' => Pages\CreateDistrito::route('/create'),
            'edit' => Pages\EditDistrito::route('/{record}/edit'),
        ];
    }
}
