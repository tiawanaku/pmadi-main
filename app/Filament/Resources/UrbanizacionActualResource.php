<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UrbanizacionActualResource\Pages;
use App\Models\UrbanizacionActual;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UrbanizacionActualResource extends Resource
{
    protected static ?string $model = UrbanizacionActual::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nombre_urb_actual')
                    ->label('Nombre de la Urbanización')
                    ->required(),

                Select::make('id_distrito')
                    ->label('Distrito')
                    ->relationship('distrito', 'nombre_distrito')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_urb_actual')
                    ->label('Nombre de la Urbanización'),

                TextColumn::make('distrito.nombre_distrito') // Muestra el nombre del distrito
                    ->label('Distrito'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define aquí las relaciones adicionales, si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUrbanizacionActuals::route('/'),
            'create' => Pages\CreateUrbanizacionActual::route('/create'),
            'edit' => Pages\EditUrbanizacionActual::route('/{record}/edit'),
        ];
    }
}
