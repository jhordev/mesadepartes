<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Lista de usuarios con las áreas disponibles + buscador.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Si deseas paginación
        $usuarios = User::with('areas')
            ->when($search, function($q) use ($search) {
                $q->where('Nombre', 'LIKE', "%{$search}%")
                    ->orWhere('Correo', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        // Cargas áreas si las necesitas para el modal
        $areas = Areas::all();

        return view('admin.users', compact('usuarios', 'areas'));
    }

    /**
     * Búsqueda AJAX que retorna SOLO el body de la tabla en HTML.
     */
    public function search(Request $request)
    {
        $query = $request->input('search', '');

        // Filtrar usuarios según búsqueda (Nombre o Correo)
        $usuarios = User::with('areas')
            ->when($query, function($q) use ($query) {
                $q->where('Nombre', 'LIKE', "%{$query}%")
                    ->orWhere('Correo', 'LIKE', "%{$query}%");
            })
            ->get();

        // Retornamos SOLO el HTML del <tbody> como en tu ejemplo
        $html = view('components.users.table-body', compact('usuarios'))->render();

        return response()->json([
            'html' => $html,
        ]);
    }


    /**
     * Almacena un nuevo usuario y retorna JSON.
     */
    public function store(Request $request)
    {
        // Validación para crear
        $validatedData = $request->validate([
            'Nombre'     => 'required|string|min:10',
            'Correo'     => 'required|email|unique:Usuarios,Correo',
            'Contraseña' => 'required|string|min:6',
            'ID_Rol'     => 'required|in:1,2',
            'ID_Area'    => 'nullable|exists:Areas,ID_Area',
        ], [
            'Nombre.required'     => 'El campo Nombre es obligatorio.',
            'Nombre.min'          => 'El Nombre debe tener al menos 10 caracteres.',
            'Correo.required'     => 'El campo Correo es obligatorio.',
            'Correo.email'        => 'El Correo debe ser una dirección de email válida.',
            'Correo.unique'       => 'El Correo ya está registrado.',
            'Contraseña.required' => 'El campo Contraseña es obligatorio.',
            'Contraseña.min'      => 'La Contraseña debe tener al menos 6 caracteres.',
            'ID_Rol.required'     => 'Debe seleccionar un Rol.',
            'ID_Rol.in'           => 'El Rol seleccionado no es válido.',
            'ID_Area.exists'      => 'El Área seleccionada no es válida.',
        ]);

        // Crear el usuario
        $user = User::create([
            'Nombre'     => $validatedData['Nombre'],
            'Correo'     => $validatedData['Correo'],
            'Contraseña' => Hash::make($validatedData['Contraseña']),
            'ID_Rol'     => $validatedData['ID_Rol'],
        ]);

        // Vincular área, si se especificó
        if (!empty($validatedData['ID_Area'])) {
            $user->areas()->attach($validatedData['ID_Area']);
        }

        // Retornar JSON de éxito
        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente.'
        ]);
    }

    /**
     * Actualiza un usuario existente y retorna JSON.
     */
    public function update(Request $request, $id)
    {
        // Validación para actualizar
        $validatedData = $request->validate([
            'Nombre'     => 'required|string|max:255',
            'Correo'     => 'required|email|unique:Usuarios,Correo,' . $id . ',ID_Usuario',
            'Contraseña' => 'nullable|string|min:6',
            'ID_Rol'     => 'required|in:1,2',
            'ID_Area'    => 'nullable|exists:Areas,ID_Area',
        ], [
            'Nombre.required'     => 'El campo Nombre es obligatorio.',
            'Nombre.max'          => 'El Nombre no debe exceder 255 caracteres.',
            'Correo.required'     => 'El campo Correo es obligatorio.',
            'Correo.email'        => 'El Correo debe ser una dirección de email válida.',
            'Correo.unique'       => 'El Correo ya está registrado.',
            'Contraseña.min'      => 'La Contraseña debe tener al menos 6 caracteres.',
            'ID_Rol.required'     => 'Debe seleccionar un Rol.',
            'ID_Rol.in'           => 'El Rol seleccionado no es válido.',
            'ID_Area.exists'      => 'El Área seleccionada no es válida.',
        ]);

        $user = User::findOrFail($id);

        $user->Nombre = $validatedData['Nombre'];
        $user->Correo = $validatedData['Correo'];
        $user->ID_Rol = $validatedData['ID_Rol'];

        // Solo actualizar Contraseña si se proporcionó
        if (!empty($validatedData['Contraseña'])) {
            $user->Contraseña = Hash::make($validatedData['Contraseña']);
        }

        $user->save();

        // Actualizar la relación con el Área
        if (!empty($validatedData['ID_Area'])) {
            $user->areas()->sync([$validatedData['ID_Area']]);
        } else {
            $user->areas()->detach();
        }

        // Retornamos JSON de éxito
        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente.'
        ]);
    }

    /**
     * Elimina un usuario y sus relaciones con áreas.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->areas()->detach();
        $user->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    public function countUsers()
    {
        $count = User::count();

        return response()->json(['count' => $count]);
    }
}
