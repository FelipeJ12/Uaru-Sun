<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class Breadcrumbs
{
    /**
     * Mapa de segmentos -> etiqueta “bonita”.
     * Ajusta o agrega más según tus secciones reales.
     */
    protected static array $labelMap = [
        ''            => 'Inicio',
        'home'        => 'Inicio',
        'dashboard'   => 'Panel',
        'perfil'      => 'Perfil',
        'profile'     => 'Perfil',
        'catalogo'    => 'Catálogo',
        'store'       => 'Tienda',
        'cart'        => 'Carrito',
        'checkout'    => 'Pago',
        'admin'       => 'Administración',
        'usuarios'    => 'Usuarios',
        'especies'    => 'Especies',
        'mamiferos'   => 'Mamíferos',
        'anfibio'     => 'Anfibios',
        'arboles'     => 'Árboles',
        'aves'        => 'Aves',
        'flora'       => 'Flora',
        'agricola'    => 'Agrícola',
        'jardin'      => 'Jardín',
        'medicinales' => 'Plantas medicinales',
        'peligro'     => 'En peligro',
        'peligrosos'  => 'Peligrosos',
        'paisajes'    => 'Paisajes',
        'favoritos'   => 'Favoritos',
        'comentarios' => 'Comentarios',
        'likes'       => 'Me gusta',
        'reportes'    => 'Reportes',
        'UsuarioPost' => 'Mis publicaciones',
        'courses'     => 'Cursos',
        'course'      => 'Cursos',
    ];

    /**
     * Construye breadcrumbs automáticamente desde la URL/route.
     *
     * Si la última parte es numérica (id), se omite a menos que
     * la vista pase un $title para reemplazarla.
     */
    public static function build(Request $request, ?string $overrideLastLabel = null): array
    {
        // Inicio siempre seguro, aunque no exista la ruta "home"
        $items = [
            ['label' => 'Inicio', 'url' => Route::has('home') ? route('home') : url('/')],
        ];

        $segments = $request->segments(); // p.ej. ['catalogo', '123']
        $accum = '';

        foreach ($segments as $i => $seg) {
            $accum .= '/' . $seg;
            $isLast = ($i === array_key_last($segments));

            // Si es el último y tenemos un título, lo usamos.
            if ($isLast && $overrideLastLabel) {
                $label = $overrideLastLabel;
            } else {
                // Etiqueta por mapa o “title case”
                $label = static::$labelMap[$seg] ?? Str::title(str_replace('-', ' ', $seg));
            }

            // Si el segmento es puramente numérico (ej: id) y NO es el último con título, lo saltamos
            if (ctype_digit($seg) && !$overrideLastLabel) {
                continue;
            }

            $items[] = [
                'label' => $label,
                'url'   => $isLast ? null : url($accum),
            ];
        }

        // Evitar duplicados exactos (label + url)
        $items = collect($items)->unique(function ($item) {
            return $item['label'] . '|' . ($item['url'] ?? '');
        })->values()->all();

        return $items;
    }
}
