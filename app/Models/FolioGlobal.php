<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolioGlobal extends Model
{
    use HasFactory;

    protected $table = 'folio_global';
    protected $primaryKey = 'id_folio_global';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'id_folio',
        'superficie_restante',
        'nombre_urb_anterior',
        'cod_catastral',
        'otro_estado_folio',
    ];

    // Casteo de array para estado_folio (asume que está almacenado como JSON en la base de datos)
    protected $casts = [
        'estado_folio' => 'array',
    ];

    // Relación con UrbanizacionActual (suponiendo que existe el modelo)
    public function urbanizacionActual()
    {
        return $this->belongsTo(\App\Models\UrbanizacionActual::class, 'id_urb_actual');
    }

    // Relación con Folio (suponiendo que existe el modelo)
    public function folio()
    {
        return $this->belongsTo(\App\Models\Folio::class, 'id_folio');
    }

    // Accesor para obtener nro_folio a través de la relación con Folio
    public function getNroFolioAttribute()
    {
        return $this->folio ? $this->folio->nro_folio : null;
    }

    // Ejemplo de un mutator opcional para normalizar el nombre anterior de la urbanización
    public function setNombreUrbAnteriorAttribute($value)
    {
        $this->attributes['nombre_urb_anterior'] = strtoupper($value);
    }
}

