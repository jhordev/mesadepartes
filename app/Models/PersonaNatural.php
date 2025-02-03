<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model
{
    protected $table = 'Personas_Naturales';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID_Expediente',
        'Tipo_Documento',
        'Numero_Documento',
        'Nombre',
        'Apellido_Paterno',
        'Apellido_Materno',
        'Departamento',
        'Provincia',
        'Distrito',
        'Direccion',
        'Email',
        'Telefono',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'ID_Expediente');
    }


}
