<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;

    protected $table = 'folio';

    protected $fillable = [
        'gravamen',
        'superficie',
        'cod_catastral',
        'nro_folio',
        'id_tipo_registro',
        'id_urb_actual',
        'id_testimonio',
    ];
}

