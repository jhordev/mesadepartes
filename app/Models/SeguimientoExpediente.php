<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeguimientoExpediente extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'seguimiento_expedientes';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'ID_Expediente',
        'Mensaje',
        'Documento_Adjunto',
        'created_at',
        'Estado',
        'ID_Area_Origen',
        'ID_Area_Destino',
        'ID_Usuario_Responsable',
    ];

    /**
     * Relación con el usuario responsable.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Responsable', 'ID_Usuario');
    }

    /**
     * Relación con el área de origen.
     */
    public function areaOrigen()
    {
        return $this->belongsTo(Areas::class, 'ID_Area_Origen', 'ID_Area');
    }

    /**
     * Relación con el área de destino.
     */
    public function areaDestino()
    {
        return $this->belongsTo(Areas::class, 'ID_Area_Destino', 'ID_Area');
    }
}
