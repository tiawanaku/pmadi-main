<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'distritos';

    // Definir los campos que pueden ser llenados
    protected $fillable = ['nombre_distrito'];

    // Relación hasMany con el modelo Urbanizacion
    public function urbanizaciones()
    {
        // Un distrito tiene muchas urbanizaciones
        return $this->hasMany(Urbanizacion::class, 'id_distrito');
    }
}
