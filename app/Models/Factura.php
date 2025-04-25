<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'id_cliente',
        'id_carrito',
        'fecha_compra',
        'metodo_pago',
        'estado',
        'total',
        'tipo_compra',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'id_carrito');
    }
}
