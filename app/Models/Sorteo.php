<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    use HasFactory;

    protected $table = 'sorteos';

    protected $primaryKey = 'id_sorteo';

    protected $fillable = [
        'id_rifa',
        'fecha_sorteo',
        'ganador_id_cliente',
        'numero_ganador',
        'estado',
    ];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }

    public function ganador()
    {
        return $this->hasOne(Ganador::class, 'id_sorteo');
    }
}
