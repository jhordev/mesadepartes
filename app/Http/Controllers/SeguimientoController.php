<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeguimientoExpediente;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SeguimientoController extends Controller
{
    public function agregarBasico(Request $request, $idExpediente)
    {

        try {
            // Obtener el usuario autenticado
            $usuario = auth()->user();

            if (!$usuario) {
                return redirect()->back()->withErrors(['error' => 'No se encontró un usuario autenticado.']);
            }

            // Obtener el área a la que pertenece el usuario desde la relación
            $idAreaOrigen = $usuario->areas()->first()?->ID_Area;

            // Validación de datos
            $request->validate([
                'Descripcion' => 'required|string',
                'Documento_Adjunto' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048'
            ]);

            // Manejar la subida del archivo, si existe
            $nombreArchivo = null;
            if ($request->hasFile('Documento_Adjunto')) {
                $archivo = $request->file('Documento_Adjunto');
                $nombreArchivo = $archivo->getClientOriginalName();
                $archivo->storeAs('seguimientos', $nombreArchivo, 'public');
            }

            // Crear el seguimiento con los datos requeridos
            SeguimientoExpediente::create([
                'ID_Expediente'     => $idExpediente,
                'ID_Area_Origen'    => $idAreaOrigen,
                'ID_Usuario_Responsable' => $usuario->ID_Usuario,
                'Mensaje'           => $request->Descripcion,
                'Documento_Adjunto' => $nombreArchivo,
                'created_at'        => now(),
            ]);

            // Redirigir con mensaje de éxito
            return redirect()->back()->with('success', 'Expediente asignado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Hubo un problema al asignar el expediente. Inténtalo nuevamente.']);
        }
    }

    public function verPDF($nombreDocumento)
    {
        // Ruta del archivo en el disco 'public'
        $filePath = "seguimientos/$nombreDocumento";

        // Verificar si el archivo existe en el disco 'public'
        if (Storage::disk('public')->exists($filePath)) {
            // Obtener el contenido del archivo y retornarlo con encabezados para visualizar
            $file = Storage::disk('public')->get($filePath);

            return response($file, 200)->header('Content-Type', 'application/pdf');
        }

        // Si el archivo no existe, retornar un error 404
        abort(404, 'El archivo no existe.');
    }
}
