<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaJuridica extends Model
{
    protected $table = 'Personas_Juridicas';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID_Expediente',
        'RUC',
        'Nombre_Entidad',
        'Departamento',
        'Provincia',
        'Distrito',
        'Direccion',
        'ID_Representante',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'ID_Expediente');
    }

    public function representanteLegal()
    {
        return $this->belongsTo(RepresentanteLegal::class, 'ID_Representante', 'ID');
    }
}
