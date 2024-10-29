<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolioIndividual extends Model
{
    use HasFactory;

    protected $table = 'folio_individual';

    protected $fillable = [
        'numero_folio',
        'nombre_urbanizacion',
        'codigo_catastral',
        'codigo_catastro_existe',
        'estado_folio',
        'testimonio_id',
        'observacion',
    ];

    public function testimonio()
    {
        return $this->belongsTo(Testimonio::class, 'testimonio_id');
    }
}
