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
    ];

    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio');
    }
}
