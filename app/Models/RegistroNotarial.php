<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroNotarial extends Model
{
    use HasFactory;

    protected $table = 'registro_notarial'; // Ajusta esto al nombre correcto de la tabla
    protected $primaryKey = 'id_registro_notarial'; // Si esta es la clave primaria
}


