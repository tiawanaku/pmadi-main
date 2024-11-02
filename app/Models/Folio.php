<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;
    protected $table = 'folio';
    protected $primaryKey = 'id_folio';



    protected $fillable = [
        'gravamen',
        'superficie',
        'cod_catastral',
        'nro_folio',
        'id_tipo_registro',
        'id_urb_actual',
        'id_testimonio',
    ];


    public function urbanizacionActual()
    {
        return $this->belongsTo(UrbanizacionActual::class, 'id_urb_actual');
    }
}

