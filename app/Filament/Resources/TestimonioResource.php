<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonioResource\Pages;
use App\Models\Testimonio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonioResource extends Resource
{
    protected static ?string $model = Testimonio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Wizard::make([
                Forms\Components\Wizard\Step::make('Información General')
                    ->schema([
                        Forms\Components\TextInput::make('nro_testimonio')
                            ->label('Número de Testimonio')
                            ->required(),

                            Forms\Components\Select::make('id_notario')
                           // ->label('Notario')
                           // ->relationship('notario', 'nombre_completo')
->label('notario')
->options([
'notario1' => 'Notario1',
'notario2' => 'Notario2',
])
                            ->required(),


                        Forms\Components\Select::make('id_distrito_judicial')
                           // ->label('Distrito Judicial')
                            //->relationship('distritoJudicial', 'denominacion') // Revisa si 'distritoJudicial' es la relación correcta
                            ->label('distritojudicial')
                            ->options([
                            'ditritojudicial1' => 'La Paz',
                            'distritojudicial2' => 'El Alto',
                            ])
                            ->required(),

                            Forms\Components\Select::make('id_registro_notarial')
                            //->label('Repositorio Notarial')
                            //->relationship('registroNotarial', 'descripcion')
                            ->label('registronotarial')
                            ->options([
                            'registronotarial1' => 'Notaria de Fe Publica',
                            'registronotarial2' => 'Notaria de Gobierno',
                            ])
                            ->required(),
                    ]),

                Forms\Components\Wizard\Step::make('Detalles del Testimonio')
                    ->schema([
                        Forms\Components\Textarea::make('descripcion_testimonio')
                            ->label('Descripción')
                            ->required(),

                            Forms\Components\Select::make('id_registrado_por')
                            //->label('Registrado Por')
                            //->relationship('registradoPor', 'descripcion')
                            ->label('registradopor')
                            ->options([
                            'registradopor1' => 'Ley Municipal',
                            'registradopor2' => 'Adjudicacion',
                            'registradopor3' => 'Expropiacion',
                            'registradopor4' => 'Cesion de areas',
                            ])
                            ->nullable(),

                        Forms\Components\Select::make('denominaciones')
                            //->label('Denominación')
                            //->relationship('denominaciones', 'descripcion') // Revisa si 'denominaciones' es la relación correcta
                            ->label('denominacion')
                            ->options([
                            'denominacion1' => 'Equipamiento',
                            'denominacion2' => 'Areas verdes',
                            'denominacion3' => 'Vias',

                            ])
                            ->multiple(),

                        Forms\Components\Select::make('estadoTestimonios')
                            //->label('Estado del Testimonios')
                            //->relationship('estadoTestimonios', 'descripcion') // Revisa si 'estadoTestimonios' es la relación correcta
                            ->label('estadotestimonio')
                            ->options([
                            'estado1' => 'reposicion',
                            'estado2' => '2do traslado',

                            ])
                            ->multiple(),
                    ]),
            ])->columnSpanFull()
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
                ->label('Repositorio Notarial'),
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
