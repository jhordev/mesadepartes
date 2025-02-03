<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'Expedientes';
    protected $primaryKey = 'ID_Expediente';

    // Campos asignables
    protected $fillable = [
        'Numero_Expediente',
        'Clave',
        'Tipo_Solicitante',
        'Asunto',
        'Descripcion',
        'Estado',
        'created_at',
    ];

    // Relación con Personas Naturales
    public function personaNatural()
    {
        return $this->hasOne(PersonaNatural::class, 'ID_Expediente');
    }

    // Relación con Personas Jurídicas
    public function personaJuridica()
    {
        return $this->hasOne(PersonaJuridica::class, 'ID_Expediente');
    }

    // Relación con Documentos
    public function documentos()
    {
        return $this->hasMany(DocumentoExpediente::class, 'ID_Expediente');
    }
}
