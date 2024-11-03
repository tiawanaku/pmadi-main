<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'testimonios';
    protected $primaryKey = 'id_testimonio'; // Define la clave primaria
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nro_testimonio',
        'id_notario',
        'distrito_judicial',
        'registro_notarial',
        'descripcion_testimonio',
        'otro_registrado_testimonio',
        'otro_estado_testimonio',
    ];

    // Relación con Notario
    public function notario()
    {
        return $this->belongsTo(Notario::class, 'id_notario');
    }

    // Relación muchos a muchos con Estado Testimonio
    public function estados()
    {
        return $this->belongsToMany(EstadoTestimonio::class, 'union_estado_testimonio', 'id_testimonio', 'id_estado_testimonio');
    }

    // Relación muchos a muchos con Registrado Por
    public function registros()
    {
        return $this->belongsToMany(RegistradoPor::class, 'union_registrado_testimonio', 'id_testimonio', 'id_registrado_por');
    }

    // Relación muchos a muchos con Denominación
    public function denominaciones()
    {
        return $this->belongsToMany(Denominacion::class, 'union_testimonio_denominacion', 'id_testimonio', 'id_denominacion');
    }
}
