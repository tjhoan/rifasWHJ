<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'primer_nombre_cliente',
        'segundo_nombre_cliente',
        'primer_apellido_cliente',
        'segundo_apellido_cliente',
        'correo_cliente',
        'telefono_cliente',
        'cedula',
        'estado',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    protected $primaryKey = 'id_cliente';

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'id_cliente', 'id_cliente');
    }
}
