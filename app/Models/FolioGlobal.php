<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folio; // Importa el modelo Folio aquí

class FolioGlobal extends Model
{
    use HasFactory;

    protected $table = 'folio_global';

    protected $fillable = [
        'id_folio',
        'superficie_restante',
        'nombre_urb_anterior',
        'codigo_catastral',
        'numero_catastro',
        'estado_folio',
        'otro_estado_folio',
        'testimonio',
   ];
   protected $casts = [
    'estado_folio' => 'array', // Laravel convertirá automáticamente JSON a array y viceversa
];
    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio');
    }
}
