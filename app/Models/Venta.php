<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_ventas';
    protected $fillable = ['factura', 'ticket', 'estado', 'cedula_cliente', 'id_metodo_pago', 'id_rifa'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cedula_cliente');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago');
    }

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }
}
