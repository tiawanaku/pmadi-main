<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistritoJudicial extends Model
{
    use HasFactory;

    protected $table = 'distrito_judicial'; // Ajusta el nombre correcto de la tabla aquí
    protected $primaryKey = 'id_distrito_judicial'; // Asumiendo que esta es la clave primaria
}
