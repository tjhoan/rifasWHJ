<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumeroRifa extends Model
{
    protected $table = 'numeros_rifas';
    protected $primaryKey = 'id';
    protected $fillable = ['numero', 'estado', 'id_rifa'];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }

    public function carrito()
    {
        return $this->hasMany(Carrito::class, 'id_numero');
    }
}
