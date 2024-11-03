<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denominacion extends Model
{
    use HasFactory;

    protected $table = 'denomination';
    protected $primaryKey = 'id_denominacion';

    public function testimonios()
    {
        return $this->belongsToMany(Testimonio::class, 'union_testimonio_denominacion', 'id_denominacion', 'id_testimonio');
    }
}


