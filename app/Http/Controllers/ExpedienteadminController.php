<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\User;
use App\Models\Areas;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use App\Exports\ExpedientesExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class ExpedienteadminController extends Controller
{
    public function index(Request $request)
    {
        // Capturar parámetros de búsqueda
        $search    = $request->input('search');
        $estado    = $request->input('estado');
        $fromDate  = $request->input('from_date');
        $toDate    = $request->input('to_date');

        // Construir la consulta base
        $expedientesQuery = Expediente::select(
            'expedientes.ID_Expediente AS ID',
            'expedientes.created_at AS Fecha',
            'expedientes.Numero_Expediente',
            'expedientes.Asunto',
            'expedientes.Tipo_Solicitante',
            'expedientes.Estado',
            'expedientes.Responsable',
            \DB::raw("
            CASE
                WHEN expedientes.Tipo_Solicitante = 'Natural' THEN
                    (SELECT CONCAT(pn.Nombre, ' ', pn.Apellido_Paterno, ' ', pn.Apellido_Materno)
                     FROM Personas_Naturales pn
                     WHERE pn.ID_Expediente = expedientes.ID_Expediente LIMIT 1)
                WHEN expedientes.Tipo_Solicitante = 'Juridica' THEN
                    (SELECT CONCAT(rl.Nombre, ' ', rl.Apellido_Paterno, ' ', rl.Apellido_Materno)
                     FROM Personas_Juridicas pj
                     JOIN Representantes_Legales rl ON rl.ID = pj.ID_Representante
                     WHERE pj.ID_Expediente = expedientes.ID_Expediente LIMIT 1)
                ELSE NULL
            END AS Remitente
        ")
        );

        // Filtrar por asunto o número de expediente
        $expedientesQuery->when($search, function ($query) use ($search) {
            $query->where('expedientes.Asunto', 'LIKE', "%{$search}%")
                ->orWhere('expedientes.Numero_Expediente', 'LIKE', "%{$search}%");
        });

        // Filtrar por estado
        $expedientesQuery->when($estado, function ($query) use ($estado) {
            $query->where('expedientes.Estado', $estado);
        });

        // Filtrar por rango de fechas (created_at)
        $expedientesQuery->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('expedientes.created_at', [$fromDate, $toDate]);
        });

        // Obtener la paginación
        $expedientes = $expedientesQuery
            ->orderBy('expedientes.created_at', 'desc')
            ->paginate(10)
            ->appends($request->except('page')); // para conservar filtros en links de paginación

        // Obtener la relación entre usuarios y áreas
        $relaciones = \DB::table('Usuarios_Areas')
            ->join('Usuarios', 'Usuarios_Areas.ID_Usuario', '=', 'Usuarios.ID_Usuario')
            ->join('Areas', 'Usuarios_Areas.ID_Area', '=', 'Areas.ID_Area')
            ->select('Areas.Nombre_Area', 'Usuarios.ID_Usuario')
            ->get();

        // Añadir área responsable a cada expediente
        foreach ($expedientes as $expediente) {
            $expediente->Area_Responsable = $relaciones->firstWhere('ID_Usuario', $expediente->Responsable)->Nombre_Area ?? null;
        }

        // Retornar la vista
        return view('admin.Expedienteadmin', [
            'expedientes' => $expedientes,
            'relaciones'  => $relaciones,
            'search'      => $search,
            'estado'      => $estado,
            'fromDate'    => $fromDate,
            'toDate'      => $toDate,
        ]);
    }

    public function expedientesPorResponsable(Request $request)
    {
        // 1. Tomar el ID del usuario autenticado
        $idUsuario = \Auth::id();

        // 2. Recibir valores de búsqueda y filtros
        $search   = $request->input('search');
        $estado   = $request->input('estado');
        $fromDate = $request->input('from_date');
        $toDate   = $request->input('to_date');

        // 3. Construir la consulta base SOLO para expedientes de este usuario
        $expedientesQuery = Expediente::select(
            'expedientes.ID_Expediente AS ID',
            'expedientes.created_at AS Fecha',
            'expedientes.Numero_Expediente',
            'expedientes.Asunto',
            'expedientes.Tipo_Solicitante',
            'expedientes.Estado',
            'expedientes.Responsable',
            \DB::raw("
            CASE
                WHEN expedientes.Tipo_Solicitante = 'Natural' THEN
                    (SELECT CONCAT(pn.Nombre, ' ', pn.Apellido_Paterno, ' ', pn.Apellido_Materno)
                     FROM Personas_Naturales pn
                     WHERE pn.ID_Expediente = expedientes.ID_Expediente LIMIT 1)
                WHEN expedientes.Tipo_Solicitante = 'Juridica' THEN
                    (SELECT CONCAT(rl.Nombre, ' ', rl.Apellido_Paterno, ' ', rl.Apellido_Materno)
                     FROM Personas_Juridicas pj
                     JOIN Representantes_Legales rl ON rl.ID = pj.ID_Representante
                     WHERE pj.ID_Expediente = expedientes.ID_Expediente LIMIT 1)
                ELSE NULL
            END AS Remitente
        ")
        )
            // Filtro base: solo expedientes donde 'Responsable' sea el usuario logueado
            ->where('Responsable', $idUsuario);

        // 4. Filtrar por asunto o número de expediente
        $expedientesQuery->when($search, function ($query) use ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('expedientes.Asunto', 'LIKE', "%{$search}%")
                    ->orWhere('expedientes.Numero_Expediente', 'LIKE', "%{$search}%");
            });
        });

        // 5. Filtrar por estado
        $expedientesQuery->when($estado, function ($query) use ($estado) {
            $query->where('expedientes.Estado', $estado);
        });

        // 6. Filtrar por rango de fechas (created_at)
        $expedientesQuery->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('expedientes.created_at', [$fromDate, $toDate]);
        });

        // 7. Obtener resultados con paginación
        $expedientes = $expedientesQuery
            ->orderBy('expedientes.created_at', 'desc')
            ->paginate(10)
            ->appends($request->except('page'));

        // 8. Obtener la relación entre usuarios y áreas para añadir 'Area_Responsable'
        $relaciones = \DB::table('Usuarios_Areas')
            ->join('Usuarios', 'Usuarios_Areas.ID_Usuario', '=', 'Usuarios.ID_Usuario')
            ->join('Areas', 'Usuarios_Areas.ID_Area', '=', 'Areas.ID_Area')
            ->select('Areas.Nombre_Area', 'Usuarios.ID_Usuario')
            ->get();

        foreach ($expedientes as $expediente) {
            $expediente->Area_Responsable = $relaciones->firstWhere('ID_Usuario', $expediente->Responsable)->Nombre_Area ?? null;
        }

        // 9. Retornar la vista con los datos y filtros
        return view('user.Expedienteadmin', [
            'expedientes' => $expedientes,
            'relaciones'  => $relaciones,
            'search'      => $search,
            'estado'      => $estado,
            'fromDate'    => $fromDate,
            'toDate'      => $toDate,
        ]);
    }

    public function exportarExcel(Request $request)
    {
        $estado   = $request->input('estado');
        $fromDate = $request->input('from_date');
        $toDate   = $request->input('to_date');

        return Excel::download(
            new ExpedientesExport($estado, $fromDate, $toDate),
            'expedientes.xlsx'
        );
    }

    public function countExpedientes()
    {
        $count = Expediente::count();

        return response()->json(['count' => $count]);
    }

    public function countExpedientesPorEstado()
    {
        $pendientes = Expediente::where('Estado', 'Pendiente')->count();
        $enTramite = Expediente::where('Estado', 'En Tramite')->count();
        $atendidos = Expediente::where('Estado', 'Atendido')->count();

        return response()->json([
            'pendientes' => $pendientes,
            'en_tramite' => $enTramite,
            'atendidos' => $atendidos,
        ]);
    }


    public function countUserExpedientes()
    {
        $userId = Auth::id();

        $count = Expediente::where('Responsable', $userId)->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Obtener la cantidad de expedientes pendientes asignados al usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function countUserExpedientesPendientes()
    {
        $userId = Auth::id();

        $count = Expediente::where('Responsable', $userId)
            ->where('Estado', 'Pendiente')
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Obtener la cantidad de expedientes en trámite asignados al usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function countUserExpedientesEnTramite()
    {
        $userId = Auth::id();

        $count = Expediente::where('Responsable', $userId)
            ->where('Estado', 'En Tramite')
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Obtener la cantidad de expedientes atendidos asignados al usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function countUserExpedientesAtendidos()
    {
        $userId = Auth::id();

        $count = Expediente::where('Responsable', $userId)
            ->where('Estado', 'Atendido')
            ->count();

        return response()->json(['count' => $count]);
    }


}
