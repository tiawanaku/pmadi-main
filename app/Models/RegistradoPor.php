<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistradoPor extends Model
{
    use HasFactory;

    protected $table = 'registrado_por';

    // Define la clave primaria correcta
    protected $primaryKey = 'id_registrado_por';

    public function testimonios()
    {
        return $this->belongsToMany(Testimonio::class, 'union_registrado_testimonio', 'id_registrado_por', 'id_testimonio');
    }
}

