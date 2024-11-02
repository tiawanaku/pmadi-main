<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrbanizacionActual extends Model
{
    use HasFactory;

    protected $table = 'urbanizacion_actual';

    protected $primaryKey = 'id_urb_actual'; // Define la clave primaria como 'id_urb_actual'

    protected $fillable = [
        'nombre_urb_actual',
        'id_distrito',
    ];

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }
    // En tu modelo Urbanizacion.php

    public function setNombreUrbActualAttribute($value)
    {
        // Convertir a mayúsculas y eliminar espacios extra
        $nombreLimpio = preg_replace('/\s+/', ' ', trim($value)); // Quita espacios duplicados y en los bordes
        $this->attributes['nombre_urb_actual'] = strtoupper($nombreLimpio);
    }

    
}
