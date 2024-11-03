<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolioIndividual extends Model
{
    use HasFactory;

    protected $table = 'folio_individual';

    protected $fillable = [
        'nro_folio',
        'nombre_urb_actual',
        'codigo_catastral',
        'codigo_catastro_existe',
        'estado_folio',
        'testimonio_id',
        'observacion',
    ];

    protected $casts = [
        'estado_folio' => 'array', // convierte estado_folio a array si es de tipo JSON
    ];

    // relación con Testimonio
    public function testimonio()
    {
        // si la clave primaria en testimonios es 'id_testimonio', use este ajuste
        return $this->belongsTo(Testimonio::class, 'testimonio_id', 'id_testimonio');
    }
}
