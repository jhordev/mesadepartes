<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'Areas';
    protected $primaryKey = 'ID_Area';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Area',
        'Descripcion',
        'ID_Creador',
    ];

    /**
     * Relación muchos a muchos con el modelo User.
     */
    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,         // Modelo relacionado
            'Usuarios_Areas',    // Nombre de la tabla pivot
            'ID_Area',           // Clave foránea de este modelo en la tabla pivot
            'ID_Usuario'         // Clave foránea del modelo relacionado en la tabla pivot
        );
    }
}
