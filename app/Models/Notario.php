<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_notario'; // Cambia la clave primaria
    public $incrementing = true;
    protected $keyType = 'int';




    protected $fillable = ['nombre_completo', 'nro_notaria'];
}


