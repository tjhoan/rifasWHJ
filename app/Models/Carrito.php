<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    protected $primaryKey = 'id_carrito';

    protected $fillable = [
        'id_cliente',
        'estado',
    ];

    public function numeros()
    {
        return $this->belongsToMany(NumerosRifa::class, 'carrito_numeros', 'id_carrito', 'id_numero');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->numeros as $numero) {
            $total += $numero->rifa->precio_boleto;
        }
        return $total;
    }
}
