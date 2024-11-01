<?php

namespace App\Models;
use App\Models\Urbanizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'distritos';

    // Especifica los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'nombre_distrito',
        'location',
    ];

    // Define la clave primaria si no es "id"
    protected $primaryKey = 'id_distrito';

    // No necesitas definir ningún "cast" para unsignedBigInteger.

    protected $appends = [
        'location',
    ];

    public function location(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => json_encode([
                'lat' => (float) $attributes['lat'],
                'lng' => (float) $attributes['lng'],
            ]),
            set: fn ($value) => [
                'lat' => $value['lat'],
                'lng' => $value['lng'],
            ],
        );
    }
}

// En la migración correspondiente, agrega la columna "location" en el esquema de la tabla:

// La columna 'location' ya existe, se omite la modificación del esquema para evitar duplicados.
// Schema::table('distritos', function (Blueprint $table) {
//     \$table->json('location')->nullable();
// });
