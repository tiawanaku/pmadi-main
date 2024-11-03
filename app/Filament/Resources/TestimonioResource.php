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
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use App\Models\EstadoTestimonio;
use App\Models\RegistradoPor;
use App\Models\Denominacion;

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
                                ->reactive()
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

                            // Relación de muchos a muchos con "Registrado por"
                            CheckboxList::make('registrado_por')
                                ->label('Registrado por')
                                ->relationship('registros', 'descripcion') // Relación de muchos a muchos con registrado_por
                                ->options(RegistradoPor::all()->pluck('descripcion', 'id_registrado_por'))
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if (in_array(RegistradoPor::where('descripcion', 'Otro')->first()->id_registrado_por, $state)) {
                                        $set('otro_registrado_testimonio', true);
                                    } else {
                                        $set('otro_registrado_testimonio', false);
                                    }
                                }),

                            // Relación de muchos a muchos con "Denominaciones"
                            Select::make('denominaciones')
                                ->label('Denominación')
                                ->relationship('denominaciones', 'descripcion') // Relación de muchos a muchos con denominaciones
                                ->multiple()
                                ->required(),

                            // Relación de muchos a muchos con "Estado Testimonio"
                            CheckboxList::make('estado_testimonio')
                                ->label('Estado Testimonio')
                                ->relationship('estados', 'descripcion') // Relación de muchos a muchos con estado_testimonio
                                ->reactive(),

                            // Campo adicional para "Especificar Otro Estado"
                            TextInput::make('otro_estado_testimonio')
                                ->label('Especificar Otro')
                                ->visible(fn ($get) => in_array(EstadoTestimonio::where('descripcion', 'Otro')->first()->id_estado_testimonio, $get('estado_testimonio') ?? []))
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
                Tables\Columns\TextColumn::make('distritoJudicial')
                    ->label('Distrito Judicial'),
                Tables\Columns\TextColumn::make('registroNotarial')
                    ->label('Registro Notarial'),
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
