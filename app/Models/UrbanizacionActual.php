<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrbanizacionActual extends Model
{
    use HasFactory;

    protected $table = 'urbanizacion_actual';
    protected $primaryKey = 'id_urb_actual';

    protected $fillable = [
        'nombre_urb_actual',
        'id_distrito',
    ];

    // Relación inversa con Folio
    public function folios()
    {
        return $this->hasMany(Folio::class, 'id_urb_actual', 'id_urb_actual');
    }

    // Relación con Distrito
    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito', 'id_distrito');
    }
}
