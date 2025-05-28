<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'correo',
        'contrasena',
        'nombre_admin',
    ];

    /**
     * Get the name of the unique identifier for the admin.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id_admin';
    }

    /**
     * Get the unique identifier for the admin.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the admin.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
