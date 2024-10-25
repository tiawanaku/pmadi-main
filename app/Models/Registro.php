<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero_registro',
        'denominacion_anterior',
        'actual_denominacion',
        'estado_actual',
        'escritura_publica',
        'fecha_escritura',
        'notaria',
        'ubicacion_notaria',
        'folio_real',
        'registro',
        'libro',
        'numero',
        'unidad_ejecutiva',
        'actualizador',
        'fecha_actualizacion',
        'codigo_catastral',
        'superficie_total',
        'registrado_por',
        'observaciones',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_escritura' => 'date',
        'fecha_actualizacion' => 'date',
    ];
}
