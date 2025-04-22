<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    protected $table = 'rifas';
    protected $primaryKey = 'id_rifa';
    protected $fillable = ['nombre', 'premio', 'precio', 'cantidad_numero', 'fecha_inicio', 'fecha_sorteo', 'id_administrador', 'id_sorteo'];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador');
    }

    public function sorteos()
    {
        return $this->belongsTo(Sorteo::class, 'id_sorteo');
    }

    public function ganadores()
    {
        return $this->hasMany(Ganador::class, 'id_rifa');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenRifa::class, 'id_rifa');
    }
}
