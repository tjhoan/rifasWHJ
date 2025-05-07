<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    use HasFactory;

    protected $table = 'rifas';

    protected $fillable = [
        'nombre_rifa',
        'imagen_rifa',
        'precio_boleto',
        'cantidad_boletos',
        'fecha_inicio',
        'fecha_sorteo',
        'premio',
        'estado',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    protected $primaryKey = 'id_rifa';

    public function numeros()
    {
        return $this->hasMany(NumerosRifa::class, 'id_rifa');
    }
    public function sorteos()
    {
        return $this->hasMany(Sorteo::class, 'id_rifa');
    }
}