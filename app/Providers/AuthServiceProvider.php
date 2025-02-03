<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Define tus políticas aquí, si es necesario.
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Gate para admin
        Gate::define('admin-access', function ($user) {
            return $user->ID_Rol == 1; // Rol de admin
        });

        // Gate para usuario
        Gate::define('user-access', function ($user) {
            return $user->ID_Rol == 2; // Rol de usuario
        });
    }
}
