<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folio;

class FolioGlobal extends Model
{
    use HasFactory;

    protected $table = 'folio_global';
    protected $primaryKey = 'id_folio_global'; // Define la clave primaria correcta
    public $incrementing = true; // Indica si es autoincremental
    protected $keyType = 'int'; // Define el tipo de dato de la clave primaria

    protected $fillable = [
        'id_folio', // Añadir `id_folio` para permitir la asignación masiva como clave foránea
        'superficie_restante',
        'nombre_urb_anterior',
        'codigo_catastral',
        'numero_catastro',
        'estado_folio',
        'otro_estado_folio',
        'testimonio',
    ];

    protected $casts = [
        'estado_folio' => 'array',
    ];

    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio');
    }
}
