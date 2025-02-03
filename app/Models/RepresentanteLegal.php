<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepresentanteLegal extends Model
{
    protected $table = 'Representantes_Legales';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'Tipo_Documento',
        'Numero_Documento',
        'Nombre',
        'Apellido_Paterno',
        'Apellido_Materno',
        'Email',
        'Telefono',
    ];

    public function representanteLegal()
    {
        // 'ID_Representante' en 'personas_juridicas' apunta a 'ID' en 'representantes_legales'
        return $this->belongsTo(RepresentanteLegal::class, 'ID_Representante', 'ID');
    }

}
