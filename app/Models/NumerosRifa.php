<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumerosRifa extends Model
{
    use HasFactory;

    protected $table = 'numeros_rifa';

    protected $fillable = [
        'id_rifa',
        'numero',
        'id_cliente',
        'fecha_accion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    protected $primaryKey = 'id_numero';

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
