<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentoExpediente;
use App\Models\Expediente;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
use App\Models\RepresentanteLegal;
use App\Models\SeguimientoExpediente;
use Illuminate\Support\Str;

class ExpedientesController extends Controller
{
    public function index(){
        return view('expedientes');
    }

    public function store(Request $request)
    {
        try {
            // 1. Validar datos generales
            $validatedData = $request->validate([
                'tipo_solicitante' => 'required|in:Natural,Juridica',
                'asunto' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'documentos.*' => 'file|max:10240',  // Max 10 MB por archivo
                'link_descarga' => 'nullable|string',
            ]);

            // 2. Generar el número de expediente
            $ultimoExpediente = Expediente::orderBy('ID_Expediente', 'desc')->first();
            $proximoID = $ultimoExpediente ? $ultimoExpediente->ID_Expediente + 1 : 1;
            $numeroExpediente = 'EXP-' . str_pad($proximoID, 6, '0', STR_PAD_LEFT);

            // 3. Generar la clave aleatoria
            $claveGenerada = Str::random(8);

            // 4. Crear el expediente
            $expediente = Expediente::create([
                'Numero_Expediente' => $numeroExpediente,
                'Clave' => $claveGenerada,
                'Tipo_Solicitante' => $request->input('tipo_solicitante'),
                'Asunto' => $request->input('asunto'),
                'Descripcion' => $request->input('descripcion'),
                'Estado' => 'Pendiente',
            ]);

            // 5. Guardar datos del solicitante
            if ($request->tipo_solicitante === 'Natural') {
                // Validar datos de la persona natural
                //dd(request()->all());
                $personaNaturalData = $request->validate([
                    'tipo_documento' => 'required|string',
                    'numero_documento' => 'required|string',
                    'nombre' => 'required|string',
                    'apellido_paterno' => 'required|string',
                    'apellido_materno' => 'nullable|string',
                    'natural_departamento' => 'nullable|string',
                    'natural_provincia' => 'nullable|string',
                    'natural_distrito' => 'nullable|string',
                    'natural_direccion' => 'nullable|string',
                    'email' => 'nullable|email',
                    'telefono' => 'nullable|string',
                ]);

                // Crear la persona natural
                PersonaNatural::create([

                    'ID_Expediente' => $expediente->ID_Expediente,
                    'Tipo_Documento' => $personaNaturalData['tipo_documento'],
                    'Numero_Documento' => $personaNaturalData['numero_documento'],
                    'Nombre' => $personaNaturalData['nombre'],
                    'Apellido_Paterno' => $personaNaturalData['apellido_paterno'],
                    'Apellido_Materno' => $personaNaturalData['apellido_materno'] ?? null,
                    'Departamento' => $personaNaturalData['natural_departamento'] ?? null,
                    'Provincia' => $personaNaturalData['natural_provincia'] ?? null,
                    'Distrito' => $personaNaturalData['natural_distrito'] ?? null,
                    'Direccion' => $personaNaturalData['natural_direccion'] ?? null,
                    'Email' => $personaNaturalData['email'] ?? null,
                    'Telefono' => $personaNaturalData['telefono'] ?? null,
                ]);

            } else {
                // Validar datos de la persona jurídica
                $personaJuridicaData = $request->validate([
                    'ruc' => 'required|string',
                    'nombre_entidad' => 'required|string',
                    'departamento' => 'nullable|string',
                    'provincia' => 'nullable|string',
                    'distrito' => 'nullable|string',
                    'direccion' => 'nullable|string',
                ]);

                // Validar datos del representante legal
                $representanteLegalData = $request->validate([
                    'rep_tipo_documento' => 'required|string',
                    'rep_numero_documento' => 'required|string',
                    'rep_nombre' => 'required|string',
                    'rep_apellido_paterno' => 'required|string',
                    'rep_apellido_materno' => 'nullable|string',
                    'rep_email' => 'nullable|email',
                    'rep_telefono' => 'nullable|string',
                ]);

                // Crear el representante legal
                $representante = RepresentanteLegal::create([
                    'Tipo_Documento' => $representanteLegalData['rep_tipo_documento'],
                    'Numero_Documento' => $representanteLegalData['rep_numero_documento'],
                    'Nombre' => $representanteLegalData['rep_nombre'],
                    'Apellido_Paterno' => $representanteLegalData['rep_apellido_paterno'],
                    'Apellido_Materno' => $representanteLegalData['rep_apellido_materno'] ?? null,
                    'Email' => $representanteLegalData['rep_email'] ?? null,
                    'Telefono' => $representanteLegalData['rep_telefono'] ?? null,
                ]);

                // Crear la persona jurídica
                PersonaJuridica::create([
                    'ID_Expediente' => $expediente->ID_Expediente,
                    'RUC' => $personaJuridicaData['ruc'],
                    'Nombre_Entidad' => $personaJuridicaData['nombre_entidad'],
                    'Departamento' => $personaJuridicaData['departamento'] ?? null,
                    'Provincia' => $personaJuridicaData['provincia'] ?? null,
                    'Distrito' => $personaJuridicaData['distrito'] ?? null,
                    'Direccion' => $personaJuridicaData['direccion'] ?? null,
                    'ID_Representante' => $representante->ID,
                ]);
            }

            // 6. Manejo de documentos adjuntos
            if ($request->hasFile('documentos')) {
                foreach ($request->file('documentos') as $documento) {
                    // Obtener el nombre original del archivo
                    $nombreOriginal = $documento->getClientOriginalName();

                    // Crear el nombre del archivo con el formato: CódigoExpediente_NombreOriginal
                    $codigoExpediente = $expediente->Numero_Expediente; // Asegúrate de que la tabla Expedientes tiene este campo
                    $nombreUnico = $codigoExpediente . '_' . $nombreOriginal;

                    // Guardar el archivo en la carpeta 'expedientes' del disco 'public'
                    $rutaGuardada = $documento->storeAs('expedientes', $nombreUnico, 'public');

                    DocumentoExpediente::create([
                        'ID_Expediente' => $expediente->ID_Expediente,
                        'Nombre_Documento' => $nombreUnico,  // Guarda el nombre original
                        'Link_Documento' => $expediente->Link_Expediente,     // Guarda el nombre completo generado
                    ]);
                }
            }

            // 7. Manejo de link de descarga alternativo
            if ($request->filled('link_descarga')) {
                DocumentoExpediente::create([
                    'ID_Expediente' => $expediente->ID_Expediente,
                    'Nombre_Documento' => 'Link de descarga',
                    'Link_Documento' => $request->input('link_descarga'),
                ]);
            }

            // 8. Redirigir con mensaje de éxito
            return redirect()->route('home')->with([
                'numeroExpediente' => $expediente->Numero_Expediente,
                'claveExpediente'  => $expediente->Clave
            ]);
        }catch (\Exception $e) {
            // Si ocurre algún problema, capturamos la excepción y redirigimos con mensaje de error
            return redirect()->route('home')->with('error',
                'Hubo un error al registrar el expediente: ' . $e->getMessage()
            );
        }
    }

    public function consultarPorNumeroYClave(Request $request)
    {
        // 1. Validar campos del formulario
        $request->validate([
            'numero_expediente' => 'required|string',
            'clave'             => 'required|string',
        ]);

        // 2. Capturar inputs
        $numeroExpediente = $request->input('numero_expediente');
        $clave            = $request->input('clave');

        try {


            // 3. Buscar el Expediente principal usando Número + Clave
            $expediente = Expediente::where('Numero_Expediente', $numeroExpediente)
                ->where('Clave', $clave)
                ->firstOrFail();

            // 4. Extraer el ID para usarlo en las demás consultas
            $idExpediente = $expediente->ID_Expediente;

            // 5. Obtener datos relacionados
            $personaNatural = PersonaNatural::where('ID_Expediente', $idExpediente)->first();
            $documentos = DocumentoExpediente::where('ID_Expediente', $idExpediente)->get();
            $personaJuridica = PersonaJuridica::where('ID_Expediente', $idExpediente)->first();
            $representanteLegal = $personaJuridica
                ? RepresentanteLegal::find($personaJuridica->ID_Representante)
                : null;

            // 6. Obtener seguimientos en orden descendente
            $seguimientos = \App\Models\SeguimientoExpediente::with(['usuario', 'areaOrigen'])
                ->where('ID_Expediente', $idExpediente)
                ->orderBy('created_at', 'desc')
                ->get();

            // 7. Asignar numeración decreciente
            $totalSeguimientos = count($seguimientos);
            $numeroSecuencia = $totalSeguimientos;
            foreach ($seguimientos as $seguimiento) {
                $seguimiento->NumeroSecuencia = $numeroSecuencia;
                $numeroSecuencia--;
            }

            // 8. Retornar la misma vista de detalles
            return view('expedientes', compact(
                'expediente',
                'personaNatural',
                'documentos',
                'personaJuridica',
                'representanteLegal',
                'seguimientos'
            ));
        } catch (ModelNotFoundException $e) {
            // Redirigir de vuelta con el mensaje de error
            return redirect()->back()->with('error', 'No se encontró expediente.');
        } catch (\Exception $e) {
            // Manejo de otros posibles errores
            return redirect()->back()->with('error', 'No se encontró expediente verifique sus datos');
        }
    }



}
