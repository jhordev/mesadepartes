<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PersonaNatural;
use App\Models\SeguimientoExpediente;
use App\Models\DocumentoExpediente;
use App\Models\PersonaJuridica;
use App\Models\RepresentanteLegal;


class ExpedientedetailsController extends Controller
{
    public function detalle($id)
    {
        // Obtener el expediente principal
        $expediente = Expediente::findOrFail($id);

        // Obtener datos relacionados
        $personaNatural = PersonaNatural::where('ID_Expediente', $id)->first();
        $documentos     = DocumentoExpediente::where('ID_Expediente', $id)->get();
        $personaJuridica = PersonaJuridica::where('ID_Expediente', $id)->first();
        $representanteLegal = $personaJuridica ? RepresentanteLegal::find($personaJuridica->ID_Representante) : null;

        // Obtener los seguimientos en orden descendente
        $seguimientos = \App\Models\SeguimientoExpediente::with(['usuario', 'areaOrigen'])
            ->where('ID_Expediente', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Asignar numeración decreciente
        $totalSeguimientos = count($seguimientos);  // ej. 10
        $numeroSecuencia = $totalSeguimientos;      // 10

        foreach ($seguimientos as $seguimiento) {
            $seguimiento->NumeroSecuencia = $numeroSecuencia;
            $numeroSecuencia--;                   // va bajando 10,9,8...
        }

        return view('admin.expedientedetails', compact(
            'expediente',
            'personaNatural',
            'documentos',
            'personaJuridica',
            'representanteLegal',
            'seguimientos'
        ));
    }

    public function verPDF($nombreDocumento)
    {
        // Ruta del archivo en el disco 'public'
        $filePath = "expedientes/$nombreDocumento";

        // Verificar si el archivo existe en el disco 'public'
        if (Storage::disk('public')->exists($filePath)) {
            // Obtener el contenido del archivo y retornarlo con encabezados para visualizar
            $file = Storage::disk('public')->get($filePath);

            return response($file, 200)->header('Content-Type', 'application/pdf');
        }

        // Si el archivo no existe, retornar un error 404
        abort(404, 'El archivo no existe.');
    }

    public function actualizarEstado(Request $request, $idExpediente)
    {
        try {
            // Validar que el estado sea uno de los permitidos
            $request->validate([
                'Estado' => 'required|in:Pendiente,En Tramite,Atendido'
            ]);

            // Actualizar el estado del expediente
            Expediente::where('ID_Expediente', $idExpediente)->update([
                'Estado' => $request->Estado
            ]);

            return redirect()->back()->with('success', 'Estado del expediente actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Hubo un problema al actualizar el estado.']);
        }
    }

    public function actualizarResponsable(Request $request, $id)
    {
        try {
            // Validar que el responsable sea un número válido
            $request->validate([
                'Responsable' => 'required|integer|exists:Usuarios,ID_Usuario'
            ]);

            // Actualizar el responsable del expediente
            Expediente::where('ID_Expediente', $id)->update([
                'Responsable' => $request->Responsable
            ]);

            return redirect()->back()->with('success', 'Responsable del expediente actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Hubo un problema al actualizar el responsable.']);
        }
    }

    public function descargarDocumento($nombreDocumento)
    {
        // Ruta del archivo en el disco 'public'
        $filePath = "expedientes/{$nombreDocumento}";

        // Verificar si el archivo existe en el disco 'public'
        if (Storage::disk('public')->exists($filePath)) {
            // Obtener el documento de la base de datos para obtener el nombre original
            $documento = DocumentoExpediente::where('Nombre_Documento', $nombreDocumento)->first();

            // Determinar el nombre de descarga (usar el nombre original si está disponible)
            $nombreDescarga = $documento ? $documento->Nombre_Documento : $nombreDocumento;

            // Retornar el archivo para descarga
            return Storage::disk('public')->download($filePath, $nombreDescarga);
        }

        // Si el archivo no existe, retornar un error 404
        abort(404, 'El archivo no existe.');
    }

}
