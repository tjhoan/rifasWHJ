<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    protected $table = 'sorteos';
    protected $primaryKey = 'id_sorteo';
    protected $fillable = ['fecha_realizacion', 'estado'];

    public function rifas()
    {
        return $this->hasMany(Rifa::class, 'id_sorteo');
    }

    public function ganadores()
    {
        return $this->hasMany(Ganador::class, 'id_sorteo');
    }
}
