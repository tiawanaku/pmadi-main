<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'testimonios';
    protected $primaryKey = 'id_testimonio'; // Cambia la clave primaria a 'id_testimonio'
    public $incrementing = true; // Asegura que el campo sea auto-incremental si es necesario
    protected $keyType = 'int'; // Define el tipo de dato de la clave primaria

    // Permite la asignación masiva para los atributos especificados
    protected $fillable = [
        'nro_testimonio',
        'id_notario',
        'id_distrito_judicial',
        'id_registro_notarial',
        'descripcion_testimonio',
        'id_registrado_por'
    ];

    // Relaciones
    public function notario()
    {
        return $this->belongsTo(Notario::class, 'id_notario');
    }

    public function distritoJudicial()
    {
        return $this->belongsTo(DistritoJudicial::class, 'id_distrito_judicial');
    }

    public function registroNotarial()
    {
        return $this->belongsTo(RegistroNotarial::class, 'id_registro_notarial');
    }

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'id_registrado_por');
    }

    public function denominaciones()
    {
        return $this->belongsToMany(Denominacion::class, 'union_testimonio_denominacion', 'id_testimonio', 'id_denominacion');
    }

    public function estados()
    {
        return $this->belongsToMany(EstadoTestimonio::class, 'union_estado_testimonio', 'id_testimonio', 'id_estado_testimonio');
    }
}
