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
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExpedientesController extends Controller
{
    public function index()
    {
        return view('expedientes');
    }

    public function store(Request $request)
    {
        try {
            // 1. Validar datos comunes
            $validatedData = $request->validate([
                'tipo_solicitante' => 'required|in:Natural,Juridica',
                'asunto'           => 'required|string|max:255',
                'descripcion'      => 'nullable|string',
                'documentos.*'     => 'file|max:10240',  // Máx 10 MB por archivo
                'link_descarga'    => 'nullable|string',
            ]);

            // 2. (Validaciones adicionales específicas según sea Natural o Jurídica)
            if ($request->tipo_solicitante === 'Natural') {
                // Validar longitud según "tipo_documento"
                switch($request->tipo_documento) {
                    case 'DNI':
                        $request->validate([
                            'numero_documento' => 'required|digits:8',
                        ]);
                        break;
                    case 'Carné de extranjería':
                        $request->validate([
                            'numero_documento' => 'required|digits:9',
                        ]);
                        break;
                    case 'Pasaporte':
                        $request->validate([
                            'numero_documento' => 'required|digits:7',
                        ]);
                        break;
                    case 'RUC 10':
                        $request->validate([
                            'numero_documento' => 'required|digits:10',
                        ]);
                        break;
                }

                // Validar el teléfono (opcional, pero si lo llena deben ser 9 dígitos)
                $request->validate([
                    'telefono' => 'nullable|digits:9',
                ]);

                // Validar correo Gmail (opcional, pero si lo llena debe ser @gmail.com)
                $request->validate([
                    'email' => 'nullable|email',
                ]);

            } else {
                // Persona jurídica:
                // Validar longitud de documento según "rep_tipo_documento"
                switch($request->rep_tipo_documento) {
                    case 'DNI':
                        $request->validate([
                            'rep_numero_documento' => 'required|digits:8',
                        ]);
                        break;
                    case 'Carné de extranjería':
                        $request->validate([
                            'rep_numero_documento' => 'required|digits:9',
                        ]);
                        break;
                    case 'Pasaporte':
                        $request->validate([
                            'rep_numero_documento' => 'required|digits:7',
                        ]);
                        break;
                    case 'RUC 10':
                        $request->validate([
                            'rep_numero_documento' => 'required|digits:10',
                        ]);
                        break;
                }

                // Validar el teléfono del representante (opcional, 9 dígitos)
                $request->validate([
                    'rep_telefono' => 'nullable|digits:9',
                ]);

                // Validar correo Gmail del representante (opcional, pero si lo llena, @gmail.com)
                $request->validate([
                    'email' => 'nullable|email',
                ]);
            }

            // 3. Generar número de expediente
            $ultimoExpediente = Expediente::orderBy('ID_Expediente', 'desc')->first();
            $proximoID = $ultimoExpediente ? $ultimoExpediente->ID_Expediente + 1 : 1;
            $numeroExpediente = 'EXP-' . str_pad($proximoID, 6, '0', STR_PAD_LEFT);

            // 4. Generar clave aleatoria
            $claveGenerada = Str::random(8);

            // 5. Crear el expediente
            $expediente = Expediente::create([
                'Numero_Expediente' => $numeroExpediente,
                'Clave'             => $claveGenerada,
                'Tipo_Solicitante'  => $request->input('tipo_solicitante'),
                'Asunto'            => $request->input('asunto'),
                'Descripcion'       => $request->input('descripcion'),
                'Estado'            => 'Pendiente',
            ]);

            // 6. Guardar datos del solicitante
            if ($request->tipo_solicitante === 'Natural') {
                // Validar datos de la persona natural (ya se hicieron validaciones extra arriba)
                $personaNaturalData = $request->validate([
                    'tipo_documento'      => 'required|string',
                    'numero_documento'    => 'required|string',
                    'nombre'              => 'required|string',
                    'apellido_paterno'    => 'required|string',
                    'apellido_materno'    => 'nullable|string',
                    'nombre_natural_departamento' => 'nullable|string',
                    'nombre_natural_provincia'   => 'nullable|string',
                    'nombre_natural_distrito'    => 'nullable|string',
                    'natural_direccion'   => 'nullable|string',
                    'email'               => 'nullable|string', // 'email' se valida arriba
                    'telefono'            => 'nullable|string', // 'telefono' se valida arriba
                ]);

                // Crear persona natural
                PersonaNatural::create([
                    'ID_Expediente'   => $expediente->ID_Expediente,
                    'Tipo_Documento'  => $personaNaturalData['tipo_documento'],
                    'Numero_Documento'=> $personaNaturalData['numero_documento'],
                    'Nombre'          => $personaNaturalData['nombre'],
                    'Apellido_Paterno'=> $personaNaturalData['apellido_paterno'],
                    'Apellido_Materno'=> $personaNaturalData['apellido_materno'] ?? null,
                    'Departamento'    => $personaNaturalData['nombre_natural_departamento'] ?? null,
                    'Provincia'       => $personaNaturalData['nombre_natural_provincia'] ?? null,
                    'Distrito'        => $personaNaturalData['nombre_natural_distrito'] ?? null,
                    'Direccion'       => $personaNaturalData['natural_direccion'] ?? null,
                    'Email'           => $personaNaturalData['email'] ?? null,
                    'Telefono'        => $personaNaturalData['telefono'] ?? null,
                ]);

            } else {
                // Persona jurídica
                $personaJuridicaData = $request->validate([
                    'ruc'               => 'required|string',
                    'nombre_entidad'    => 'required|string',
                    'nombre_departamento_juridica' => 'nullable|string',
                    'nombre_provincia_juridica'    => 'nullable|string',
                    'nombre_distrito_juridica'     => 'nullable|string',
                    'direccion_juridica'    => 'nullable|string',
                ]);

                // Representante legal
                $representanteLegalData = $request->validate([
                    'rep_tipo_documento'    => 'required|string',
                    'rep_numero_documento'  => 'required|string',
                    'rep_nombre'            => 'required|string',
                    'rep_apellido_paterno'  => 'required|string',
                    'rep_apellido_materno'  => 'nullable|string',
                    'rep_email'             => 'nullable|string',
                    'rep_telefono'          => 'nullable|string',
                ]);

                // Crear representante
                $representante = RepresentanteLegal::create([
                    'Tipo_Documento'     => $representanteLegalData['rep_tipo_documento'],
                    'Numero_Documento'   => $representanteLegalData['rep_numero_documento'],
                    'Nombre'             => $representanteLegalData['rep_nombre'],
                    'Apellido_Paterno'   => $representanteLegalData['rep_apellido_paterno'],
                    'Apellido_Materno'   => $representanteLegalData['rep_apellido_materno'] ?? null,
                    'Email'              => $representanteLegalData['rep_email'] ?? null,
                    'Telefono'           => $representanteLegalData['rep_telefono'] ?? null,
                ]);

                // Crear persona jurídica
                PersonaJuridica::create([
                    'ID_Expediente'    => $expediente->ID_Expediente,
                    'RUC'              => $personaJuridicaData['ruc'],
                    'Nombre_Entidad'   => $personaJuridicaData['nombre_entidad'],
                    'Departamento'     => $personaJuridicaData['nombre_departamento_juridica'] ?? null,
                    'Provincia'        => $personaJuridicaData['nombre_provincia_juridica'] ?? null,
                    'Distrito'         => $personaJuridicaData['nombre_distrito_juridica'] ?? null,
                    'Direccion'        => $personaJuridicaData['direccion_juridica'] ?? null,
                    'ID_Representante' => $representante->ID,
                ]);
            }

            // 7. Manejo de documentos adjuntos
            if ($request->hasFile('documentos')) {
                foreach ($request->file('documentos') as $documento) {
                    $nombreOriginal = $documento->getClientOriginalName();
                    $codigoExpediente = $expediente->Numero_Expediente;
                    $nombreUnico = $codigoExpediente . '_' . $nombreOriginal;

                    // Guardar archivo en disco 'public' carpeta 'expedientes'
                    $rutaGuardada = $documento->storeAs('expedientes', $nombreUnico, 'public');

                    DocumentoExpediente::create([
                        'ID_Expediente'   => $expediente->ID_Expediente,
                        'Nombre_Documento'=> $nombreUnico,
                        'Link_Documento'  => $expediente->Link_Expediente,
                    ]);
                }
            }

            // 8. Manejo de link de descarga alternativo
            if ($request->filled('link_descarga')) {
                DocumentoExpediente::create([
                    'ID_Expediente'   => $expediente->ID_Expediente,
                    'Nombre_Documento'=> 'Link de descarga',
                    'Link_Documento'  => $request->input('link_descarga'),
                ]);
            }

            // 9. Redirigir con éxito
            return redirect()->route('home')->with([
                'numeroExpediente' => $expediente->Numero_Expediente,
                'claveExpediente'  => $expediente->Clave
            ]);

        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('home')->with(
                'error',
                'Hubo un error al registrar el expediente: ' . $e->getMessage()
            );
        }
    }

    public function consultarPorNumeroYClave(Request $request)
    {
        // 1. Validar
        $request->validate([
            'numero_expediente' => 'required|string',
            'clave'             => 'required|string',
        ]);

        $numeroExpediente = $request->input('numero_expediente');
        $clave            = $request->input('clave');

        try {
            // 2. Buscar
            $expediente = Expediente::where('Numero_Expediente', $numeroExpediente)
                ->where('Clave', $clave)
                ->firstOrFail();

            $idExpediente = $expediente->ID_Expediente;

            // 3. Datos relacionados
            $personaNatural = PersonaNatural::where('ID_Expediente', $idExpediente)->first();
            $documentos     = DocumentoExpediente::where('ID_Expediente', $idExpediente)->get();
            $personaJuridica = PersonaJuridica::where('ID_Expediente', $idExpediente)->first();
            $representanteLegal = $personaJuridica
                ? RepresentanteLegal::find($personaJuridica->ID_Representante)
                : null;

            // 4. Seguimientos
            $seguimientos = SeguimientoExpediente::with(['usuario', 'areaOrigen'])
                ->where('ID_Expediente', $idExpediente)
                ->orderBy('created_at', 'desc')
                ->get();

            // Numeración inversa
            $totalSeguimientos = count($seguimientos);
            $numeroSecuencia   = $totalSeguimientos;
            foreach ($seguimientos as $seguimiento) {
                $seguimiento->NumeroSecuencia = $numeroSecuencia;
                $numeroSecuencia--;
            }

            return view('expedientes', compact(
                'expediente',
                'personaNatural',
                'documentos',
                'personaJuridica',
                'representanteLegal',
                'seguimientos'
            ));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No se encontró expediente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se encontró expediente verifique sus datos');
        }
    }
}
