<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ganador extends Model
{
    protected $table = 'ganadores';
    protected $primaryKey = 'id_ganador';
    protected $fillable = ['boletos_ganador', 'nombre_ganador', 'id_sorteo', 'id_rifa'];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }

    public function sorteo()
    {
        return $this->belongsTo(Sorteo::class, 'id_sorteo');
    }
}
