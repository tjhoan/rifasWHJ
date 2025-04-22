<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenRifa extends Model
{
    protected $table = 'imagen_rifa';
    protected $primaryKey = 'id_imagen';
    protected $fillable = ['ruta_imagen', 'id_rifa'];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class, 'id_rifa');
    }
}
