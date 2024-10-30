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
}
