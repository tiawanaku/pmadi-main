<?php

// app/Models/RegistradoPor.php
// app/Models/RegistradoPor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistradoPor extends Model
{
    use HasFactory;

    protected $table = 'registrado_por'; // Nombre correcto de la tabla
    protected $primaryKey = 'id_registrado_por'; // Ajusta esto si la clave primaria es diferente
}

