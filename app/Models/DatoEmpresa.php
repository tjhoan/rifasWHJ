<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoEmpresa extends Model
{
    protected $table = 'datos_empresa';
    protected $primaryKey = 'NIT';
    protected $fillable = ['nombre_empresa', 'direccion', 'celular', 'redes_sociales', 'id_administrador'];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador');
    }
}
