<?php
// app/Models/Denominacion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denominacion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre']; // Ajusta según los campos de la tabla

    public function testimonios()
    {
        return $this->belongsToMany(Testimonio::class, '_testimonio_denominacion', 'id_denominacion', 'id_testimonio');
    }
}


