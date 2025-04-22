<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';
    protected $fillable = ['id_rifa', 'id_numero', 'cantidad', 'fecha_creacion'];

    public $timestamps = false;

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }

    public function numero()
    {
        return $this->belongsTo(NumeroRifa::class, 'id_numero');
    }
}
