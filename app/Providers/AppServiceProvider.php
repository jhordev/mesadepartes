<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios en el contenedor de servicios.
     *
     * Este método se ejecuta antes de que el framework esté completamente cargado.
     */
    public function register()
    {
        // Puedes registrar servicios personalizados si lo necesitas.
    }

    /**
     * Ejecuta configuraciones después de que la aplicación está cargada.
     *
     * Aquí puedes registrar Gates, configuraciones de Blade, paginación, etc.
     */
    public function boot()
    {
        // ==============================
        // Gates para manejo de roles
        // ==============================
        Gate::define('admin-access', function ($user) {
            return $user->ID_Rol == 1; // Admin
        });

        Gate::define('user-access', function ($user) {
            return $user->ID_Rol == 2; // Usuario
        });

        // ==============================
        // Configuración de paginación
        // ==============================
        Paginator::useBootstrap(); // Si usas Bootstrap para los enlaces de paginación.

        // ==============================
        // Directivas personalizadas de Blade (opcional)
        // ==============================
        \Blade::directive('role', function ($expression) {
            return "<?php if(auth()->check() && auth()->user()->ID_Rol == $expression): ?>";
        });

        \Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
