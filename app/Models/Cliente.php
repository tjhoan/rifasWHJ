<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'cedula';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'correo', 'celular'];

    public $timestamps = false;

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cedula_cliente');
    }
}
