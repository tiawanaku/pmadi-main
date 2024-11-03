<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTestimonio extends Model
{
    use HasFactory;

    protected $table = 'estado_testimonio';

    // Definir la clave primaria correcta
    protected $primaryKey = 'id_estado_testimonio';

    public function testimonios()
    {
        return $this->belongsToMany(Testimonio::class, 'union_estado_testimonio', 'id_estado_testimonio', 'id_testimonio');
    }
}
