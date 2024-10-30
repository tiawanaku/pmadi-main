<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistritoJudicial extends Model
{
    use HasFactory;

    protected $table = 'distritos';

    // Define la clave primaria personalizada
    protected $primaryKey = 'id_distrito';

    // Si `id_distrito` no es autoincremental, desactiva $incrementing
    public $incrementing = true;

    // Si `id_distrito` es de tipo unsignedBigInteger, agrega la propiedad:
    protected $keyType = 'unsignedBigInteger';
}
