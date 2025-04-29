<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ganador extends Model
{
    use HasFactory;

    protected $table = 'ganadores';

    protected $fillable = [
        'id_sorteo',
        'id_cliente',
        'fecha_ganador',
        'estado',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    protected $primaryKey = 'id_ganador';

    public function sorteo()
    {
        return $this->belongsTo(Sorteo::class, 'id_sorteo');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
