<?php

namespace App\Providers;

use App\Models\Empresa;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Aquí puedes registrar servicios en el contenedor si es necesario
    }

    public function boot(): void
    {
        // Configurar paginación para Bootstrap
        Paginator::useBootstrap();

        // Compartir datos de redes sociales sólo si la tabla 'empresa' existe
        if (Schema::hasTable('empresa')) {
            $empresa = Empresa::first();
            $redesSociales = $empresa ? $empresa->redes_sociales : [];
        } else {
            $redesSociales = [];
        }

        // Compartir la variable con todas las vistas
        View::share('redesSociales', $redesSociales);
    }
}