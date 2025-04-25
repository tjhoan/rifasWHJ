<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre_cliente',
        'correo_cliente',
        'telefono_cliente',
        'direccion_cliente',
        'estado',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'id_cliente');
    }
}
