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
                $title = $data['title'] ?? null;
                $items = $data['items'] ?? null; // ← Nuevo: breadcrumbs personalizados

                if (class_exists(Breadcrumbs::class)) {
                    if ($items) {
                        // Si la vista envía $items, usamos eso
                        $view->with('autoBreadcrumbs', $items);
                    } else {
                        // Si no hay $items, generamos automáticos
                        $auto = Breadcrumbs::build($request, $title);
                        $view->with('autoBreadcrumbs', $auto);
                    }
                }
            } catch (\Throwable $e) {
                $view->with('autoBreadcrumbs', []);
            }
        });
    }
}
