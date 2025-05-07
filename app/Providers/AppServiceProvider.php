<?php

namespace App\Providers;

use App\Models\Empresa;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrap();

        $empresa = Empresa::first();
        $redesSociales = $empresa ? $empresa->redes_sociales : [];
        View::share('redesSociales', $redesSociales);
    }
}
