<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'Usuarios';
    protected $primaryKey = 'ID_Usuario';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Correo',
        'Contraseña',
        'ID_Rol',
    ];

    protected $hidden = ['Contraseña'];

    public function getAuthPassword()
    {
        return $this->Contraseña;
    }

    /**
     * Relación muchos a muchos con el modelo Areas.
     * Se asume que la tabla pivot se llama Usuarios_Areas.
     */
    public function areas()
    {
        return $this->belongsToMany(
            Areas::class,       // Modelo relacionado
            'Usuarios_Areas',   // Nombre de la tabla pivot
            'ID_Usuario',       // Clave foránea de este modelo en la tabla pivot
            'ID_Area'           // Clave foránea del modelo relacionado en la tabla pivot
        );
    }
}
