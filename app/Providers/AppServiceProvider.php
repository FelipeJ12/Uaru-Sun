<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Support\Breadcrumbs;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        // Compartir breadcrumbs manuales en todas las vistas
        View::composer('*', function ($view) {
            try {
                // Evitar en consola, tests y vistas de error
                if (app()->runningInConsole() || app()->runningUnitTests()) {
                    return;
                }

                $request = request();
                if (str_starts_with($request->path(), '_debugbar') || $request->is('errors/*')) {
                    return;
                }

                // Datos que vienen desde la vista
                $data  = $view->getData();
                $items = $data['items'] ?? null; // Solo usamos breadcrumbs manuales

                if ($items) {
                    $view->with('breadcrumbs', $items);
                } else {
                    // Si no hay $items, no hacemos nada
                    $view->with('breadcrumbs', []);
                }
            } catch (\Throwable $e) {
                $view->with('breadcrumbs', []);
            }
        });
    }
}
