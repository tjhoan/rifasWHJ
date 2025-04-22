<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago';
    protected $primaryKey = 'id_metodo_pago';
    protected $fillable = ['fecha_pago', 'total_pago', 'metodo_pago', 'id_administrador'];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador');
    }
}
