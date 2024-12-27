<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra cualquier servicio de la aplicación.
     */
    public function register(): void
    {
        //
    }

    /**
     * Arranca cualquier servicio de la aplicación.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Conceder implícitamente todos los permisos al rol "Super Admin"
        // Esto funciona en la aplicación utilizando funciones relacionadas con la puerta (gate) como auth()->user->can() y @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
