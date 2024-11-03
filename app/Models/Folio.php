<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoRegistro;
use App\Models\Testimonios;
use App\Models\FolioIndividual;
use App\Models\UrbanizacionActual;
use App\Models\FolioGlobal;


class Folio extends Model
{
    use HasFactory;

    // nombre de la tabla en la base de datos
    protected $table = 'folio';

    // clave primaria
    protected $primaryKey = 'id_folio';
    public $incrementing = true; // esto es correcto, ya que id_folio es autoincremental
    protected $keyType = 'integer'; // especifica que la clave es de tipo entero

    // campos que se pueden asignar masivamente
    protected $fillable = [
        'gravamen',
        'superficie',
        'cod_catastral',
        'nro_folio',
        'id_tipo_registro',
        'id_urb_actual', // este es el campo que relaciona con urbanizacion_actual
        'id_testimonio',
    ];

    // relación con la tabla UrbanizacionActual
    public function urbanizacion()
    {
        return $this->belongsTo(UrbanizacionActual::class, 'id_urb_actual', 'id_urb_actual');
    }

    // relación con la tabla TipoRegistro (suponiendo que este modelo existe)
    public function tipoRegistro()
    {
        return $this->belongsTo(Folio::class, 'id_tipo_registro', 'id');
    }

    // relación con la tabla Testimonios (suponiendo que este modelo existe)
    public function testimonio()
    {
        return $this->belongsTo(Testimonio::class, 'id_testimonio', 'id_testimonio');
    }

    // relación con FolioIndividual
    public function foliosIndividuales()
    {
        return $this->hasMany(FolioIndividual::class, 'id_folio', 'id_folio');
    }

    // relación con FolioGlobal
    public function foliosGlobales()
    {
        return $this->hasMany(FolioGlobal::class, 'id_folio', 'id_folio');
    }
}
