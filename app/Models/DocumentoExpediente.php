<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoExpediente extends Model
{
    protected $table = 'Documentos_Expedientes';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID_Expediente',
        'Nombre_Documento',
        'Link_Documento',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'ID_Expediente');
    }
}
