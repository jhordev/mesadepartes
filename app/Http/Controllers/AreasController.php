<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreasController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        // Si hay una consulta de búsqueda, filtrar los resultados
        $areas = Areas::when($query, function ($q) use ($query) {
            $q->where('Nombre_Area', 'LIKE', "%$query%")
                ->orWhere('Descripcion', 'LIKE', "%$query%");
        })->paginate(5);

        return view('admin.areas', compact('areas'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Filtrar las áreas según el término de búsqueda
        $areas = Areas::when($query, function ($q) use ($query) {
            $q->where('Nombre_Area', 'LIKE', "%$query%")
                ->orWhere('Descripcion', 'LIKE', "%$query%");
        })->get();

        // Retornar solo el cuerpo de la tabla como respuesta AJAX
        return response()->json([
            'html' => view('components.areas.table-body', compact('areas'))->render(),
        ]);
    }


    public function create()
    {
        $usuarios = User::all(); // Usuarios disponibles para seleccionar como creadores
        return view('areas.create', compact('usuarios'));
    }

    /**
     * Almacena un área en la base de datos.
     */
    public function store(Request $request)
    {// Validar los datos del formulario
        $request->validate([
            'Nombre_Area' => 'required|string|max:100',
            'Descripcion' => 'nullable|string',
        ]);

        // Crear el área y asignar automáticamente el administrador logueado como creador
        Areas::create([
            'Nombre_Area' => $request->input('Nombre_Area'),
            'Descripcion' => $request->input('Descripcion'),
            'ID_Creador'  => Auth::id(), // ID del usuario autenticado
        ]);

        return redirect()->route('areas.index')->with('success', 'Área creada correctamente.');
    }

    /**
     * Muestra el formulario para editar un área.
     */
    public function edit($id)
    {
        try {
            $area = Areas::findOrFail($id);
            $usuarios = User::all(); // Usuarios disponibles para selección
            return view('areas.edit', compact('area', 'usuarios'));
        } catch (\Exception $e) {
            return redirect()->route('areas.index')->with('error', 'No se pudo cargar el área. ' . $e->getMessage());
        }
    }


    /**
     * Actualiza un área en la base de datos.
     */
    public function update(Request $request, $id)
    {

        //dd($request->all());
        $request->validate([
            'Nombre_Area' => 'required|string|max:100',
            'Descripcion' => 'nullable|string',
            'ID_Creador'  => 'required|exists:Usuarios,ID_Usuario',
        ]);

        try {
            // Buscar el área por ID
            $area = Areas::findOrFail($id);


            // Actualizar los datos
            $area->update($request->only(['Nombre_Area', 'Descripcion', 'ID_Creador']));

            // Redirigir con mensaje de éxito
            return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
        } catch (\Exception $e) {
            // Redirigir con mensaje de error en caso de falla
            return redirect()->route('areas.index')->with('error', 'Error al actualizar el área. ' . $e->getMessage());
        }
    }


    /**
     * Elimina un área de la base de datos.
     */
    public function destroy($id)
    {
        $area = Areas::findOrFail($id);
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
    }

    public function countAreas()
    {
        $count = Areas::count();

        return response()->json(['count' => $count]);
    }

}
