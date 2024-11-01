<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonioResource\Pages;
use App\Models\Testimonio;
use App\Models\Notario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;

class TestimonioResource extends Resource
{
    protected static ?string $model = Testimonio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Información General')
                        ->schema([
                            TextInput::make('nro_testimonio')
                                ->label('Número de Testimonio')
                                ->required(),

                            // Select de notario que se actualiza automáticamente
                            Select::make('id_notario')
                                ->label('Notario')
                                ->options(function () {
                                    return Notario::all()->pluck('nombre_completo', 'id_notario');
                                })
                                ->searchable()
                                ->placeholder('Seleccione o busque el notario')
                                ->required()
                                ->reactive() // Reactivo para actualizarse solo
                                ->afterStateUpdated(function ($set, $state) {
                                    $set('nro_notaria', Notario::find($state)?->nro_notaria);
                                }),

                            TextInput::make('nro_notaria')
                                ->label('Número de Notaría')
                                ->disabled()
                                ->required(),

                            Select::make('distrito_judicial')
                                ->label('Distrito Judicial')
                                ->options([
                                    'distritojudicial1' => 'La Paz',
                                    'distritojudicial2' => 'El Alto',
                                ])
                                ->required(),

                            Select::make('registro_notarial')
                                ->label('Registro Notarial')
                                ->options([
                                    'registronotarial1' => 'Notaría de Fe Pública',
                                    'registronotarial2' => 'Notaría de Gobierno',
                                ])
                                ->required(),
                        ]),

                    Step::make('Detalles del Testimonio')
                        ->schema([
                            Forms\Components\Textarea::make('descripcion_testimonio')
                                ->label('Descripción')
                                ->required(),

                                Forms\Components\CheckboxList::make('registrado_por')
                                ->label('Registrado por')
                                ->options([
                                    'ley_municipal' => 'Ley Municipal',
                                    'adjudicacion' => 'Adjudicacion',
                                    'expropiacion' => 'Expropiacion',
                                    'cesion_de_areas' => 'Cesion de areas',

                                    'otro' => 'Otro',
                                ])
                                ->reactive(), // Forzar actualización inmediata para que se detecte la selección de "Otro"

                            // Campo adicional para "Especificar Otro"
                            Forms\Components\TextInput::make('otro_registrado_testimonio')
                                ->label('Especificar Otro')
                                ->visible(fn ($get) => in_array('otro', $get('registrado_por') ?? [])) // Solo visible si "Otro" está seleccionado
                                ->placeholder('Ingrese otro motivo de registro'),

                            Select::make('denominaciones')
                                ->label('Denominación')
                                ->options([
                                    'denominacion1' => 'Equipamiento',
                                    'denominacion2' => 'Áreas Verdes',
                                    'denominacion3' => 'Vías',
                                ])
                                ->multiple(),

                                Forms\Components\CheckboxList::make('estado_testimonio')
                                ->label('Estado Testimonio')
                                ->options([
                                    'reposicion' => 'Reposición',
                                    'segundo_traslado' => 'Segundo traslado',

                                    'otro' => 'Otro',
                                ])
                                ->reactive(),
                                Forms\Components\TextInput::make('otro_estado_testimonio')
                                ->label('Especificar Otro')
                                ->visible(fn ($get) => in_array('otro', $get('estado_testimonio') ?? [])) // Solo visible si "Otro" está seleccionado
                                ->placeholder('Ingrese otro estado de testimonio'),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nro_testimonio')
                    ->label('Número de Testimonio'),
                Tables\Columns\TextColumn::make('notario.nombre_completo')
                    ->label('Notario'),
                Tables\Columns\TextColumn::make('distritoJudicial.denominacion')
                    ->label('Distrito Judicial'),
                Tables\Columns\TextColumn::make('registroNotarial.descripcion')
                    ->label('Registro Notarial'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListTestimonios::route('/'),
            'create' => Pages\CreateTestimonios::route('/create'),
            'edit' => Pages\EditTestimonios::route('/{record}/edit'),
        ];
    }
}
