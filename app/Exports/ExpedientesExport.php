<?php

namespace App\Exports;

use App\Models\Expediente;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpedientesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $estado;
    protected $fromDate;
    protected $toDate;

    public function __construct($estado = null, $fromDate = null, $toDate = null)
    {
        $this->estado   = $estado;
        $this->fromDate = $fromDate;
        $this->toDate   = $toDate;
    }

    public function collection()
    {
        $query = Expediente::with([
            'personaNatural',
            'personaJuridica.representanteLegal',
            'documentos'
        ]);

        // (Opcional) Filtrar por usuario responsable
        if (Auth::id() > 1) {
            if (Auth::check()) {
                $query->where('Responsable', Auth::id());
            }
        }


        // Filtrar por estado si existe
        if ($this->estado) {
            $query->where('Estado', $this->estado);
        }

        // Filtrar por rango de fechas
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            // Expediente
            'Número Expediente',
            'Tipo Solicitante',
            'Asunto',
            'Descripción',
            'Estado',
            'Fecha de Creación',

            // Documentos
            'Nombre(s) de Documento(s)',
            'Link(s) de Documento(s)',

            // Persona Natural
            'PN - Tipo Documento',
            'PN - Número Documento',
            'PN - Nombres',
            'PN - Apellido Paterno',
            'PN - Apellido Materno',
            'PN - Departamento',
            'PN - Provincia',
            'PN - Distrito',
            'PN - Dirección',
            'PN - Email',
            'PN - Teléfono',

            // Persona Jurídica
            'PJ - RUC',
            'PJ - Nombre Entidad',
            'PJ - Departamento',
            'PJ - Provincia',
            'PJ - Distrito',
            'PJ - Dirección',

            // Representante Legal
            'RL - Tipo Documento',
            'RL - Número Documento',
            'RL - Nombres',
            'RL - Apellido Paterno',
            'RL - Apellido Materno',
            'RL - Email',
            'RL - Teléfono',
        ];
    }


    public function map($expediente): array
    {
        // --- 1) Campos del Expediente ---
        $numeroExpediente = $expediente->Numero_Expediente;
        // Asegúrate de que en tu BD no tenga espacios extra
        $tipoSolicitante  = trim($expediente->Tipo_Solicitante);
        $asunto           = $expediente->Asunto;
        $descripcion      = $expediente->Descripcion;
        $estado           = $expediente->Estado;
        // Usa 'created_at' o 'Fecha_Creacion' según tu esquema
        $fechaCreacion    = $expediente->created_at;

        // --- 2) Documentos ---
        // Unir nombres y links con coma
        $nombreDocs = $expediente->documentos->pluck('Nombre_Documento')->join(', ');
        $linkDocs   = $expediente->documentos->pluck('Link_Documento')->join(', ');

        // --- 3) Persona Natural (por defecto vacío) ---
        $pn_tipoDocumento   = '';
        $pn_numeroDocumento = '';
        $pn_nombre          = '';
        $pn_apellidoP       = '';
        $pn_apellidoM       = '';
        $pn_departamento    = '';
        $pn_provincia       = '';
        $pn_distrito        = '';
        $pn_direccion       = '';
        $pn_email           = '';
        $pn_telefono        = '';

        // --- 4) Persona Jurídica (por defecto vacío) ---
        $pj_ruc            = '';
        $pj_nombreEntidad  = '';
        $pj_departamento   = '';
        $pj_provincia      = '';
        $pj_distrito       = '';
        $pj_direccion      = '';

        // --- 5) Representante Legal (por defecto vacío) ---
        $rl_tipoDocumento  = '';
        $rl_numeroDocumento= '';
        $rl_nombre         = '';
        $rl_apellidoP      = '';
        $rl_apellidoM      = '';
        $rl_email          = '';
        $rl_telefono       = '';

        // Lógica para rellenar NATURAL vs. JURIDICA
        if (strcasecmp($tipoSolicitante, 'Natural') === 0 && $expediente->personaNatural) {
            $pn_tipoDocumento   = $expediente->personaNatural->Tipo_Documento;
            $pn_numeroDocumento = $expediente->personaNatural->Numero_Documento;
            $pn_nombre          = $expediente->personaNatural->Nombre;
            $pn_apellidoP       = $expediente->personaNatural->Apellido_Paterno;
            $pn_apellidoM       = $expediente->personaNatural->Apellido_Materno;
            $pn_departamento    = $expediente->personaNatural->Departamento;
            $pn_provincia       = $expediente->personaNatural->Provincia;
            $pn_distrito        = $expediente->personaNatural->Distrito;
            $pn_direccion       = $expediente->personaNatural->Direccion;
            $pn_email           = $expediente->personaNatural->Email;
            $pn_telefono        = $expediente->personaNatural->Telefono;

        } elseif (strcasecmp($tipoSolicitante, 'Juridica') === 0 && $expediente->personaJuridica) {
            $pj_ruc           = $expediente->personaJuridica->RUC;
            $pj_nombreEntidad = $expediente->personaJuridica->Nombre_Entidad;
            $pj_departamento  = $expediente->personaJuridica->Departamento;
            $pj_provincia     = $expediente->personaJuridica->Provincia;
            $pj_distrito      = $expediente->personaJuridica->Distrito;
            $pj_direccion     = $expediente->personaJuridica->Direccion;

            // Si existe representante legal
            if ($expediente->personaJuridica->representanteLegal) {
                $rep = $expediente->personaJuridica->representanteLegal;
                $rl_tipoDocumento   = $rep->Tipo_Documento;
                $rl_numeroDocumento = $rep->Numero_Documento;
                $rl_nombre          = $rep->Nombre;
                $rl_apellidoP       = $rep->Apellido_Paterno;
                $rl_apellidoM       = $rep->Apellido_Materno;
                $rl_email           = $rep->Email;
                $rl_telefono        = $rep->Telefono;
            }
        }

        // Retorno en orden EXACTO de 'headings()'
        return [
            $numeroExpediente,
            $tipoSolicitante,
            $asunto,
            $descripcion,
            $estado,
            $fechaCreacion,

            $nombreDocs,
            $linkDocs,

            $pn_tipoDocumento,
            $pn_numeroDocumento,
            $pn_nombre,
            $pn_apellidoP,
            $pn_apellidoM,
            $pn_departamento,
            $pn_provincia,
            $pn_distrito,
            $pn_direccion,
            $pn_email,
            $pn_telefono,

            $pj_ruc,
            $pj_nombreEntidad,
            $pj_departamento,
            $pj_provincia,
            $pj_distrito,
            $pj_direccion,

            $rl_tipoDocumento,
            $rl_numeroDocumento,
            $rl_nombre,
            $rl_apellidoP,
            $rl_apellidoM,
            $rl_email,
            $rl_telefono,
        ];
    }
}
