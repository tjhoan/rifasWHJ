<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'id_administrador';
    protected $fillable = ['correo', 'contrasena', 'nombre_admin'];

    public function metodosPago()
    {
        return $this->hasMany(MetodoPago::class, 'id_administrador');
    }

    public function rifas()
    {
        return $this->hasMany(Rifa::class, 'id_administrador');
    }

    public function datosEmpresa()
    {
        return $this->hasOne(DatoEmpresa::class, 'id_administrador');
    }
}
