<?php

namespace App\Models;
use App\Models\Urbanizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'distritos';

    // Especifica los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'nombre_distrito',
    ];

    // Define la clave primaria si no es "id"
    protected $primaryKey = 'id_distrito';

    // No necesitas definir ningún "cast" para unsignedBigInteger.
}
