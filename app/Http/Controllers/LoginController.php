<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Procesa la autenticación del usuario.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario.
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Credenciales para la autenticación.
        $credentials = [
            'Correo'   => $request->input('email'),
            'password' => $request->input('password')
        ];

        // Intentar autenticar al usuario.
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Redirigir según el rol del usuario.
            if ($user->ID_Rol == 1) { // Admin
                return redirect()->route('admin.inicio')->with('success', 'Bienvenido, ' . $user->Nombre . '!');
            }

            if ($user->ID_Rol == 2) { // Usuario
                $area = $user->areas()->first();
                // Rediriges a tu propia ruta y pasas el ID de área si quieres:
                return redirect()->route('user.inicio', ['area' => $area ? $area->ID_Area : null])
                    ->with('success', 'Bienvenido, ' . $user->Nombre . '!');
            }

            // Si el rol no coincide, redirigir al home.
            return redirect()->route('home')->with('error', 'Rol no reconocido.');
        }

        // Si la autenticación falla.
        return back()->withInput()->withErrors(['email' => 'Las credenciales proporcionadas no son correctas.']);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar la sesión y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    }

}
