<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';
    protected $fillable = ['cantidad', 'fecha_creacion', 'id_rifa'];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }
}
