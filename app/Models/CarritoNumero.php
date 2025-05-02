<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoNumero extends Model
{
    use HasFactory;

    protected $table = 'carrito_numeros';

    public $timestamps = false;

    protected $fillable = [
        'id_carrito',
        'id_numero',
    ];
}
