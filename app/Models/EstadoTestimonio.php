<?php
// app/Models/EstadoTestimonio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTestimonio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre']; // Ajusta según los campos de la tabla

    public function testimonios()
    {
        return $this->belongsToMany(Testimonio::class, 'union_estado_testimonio', 'id_estado_testimonio', 'id_testimonio');
    }
}

