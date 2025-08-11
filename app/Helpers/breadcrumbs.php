<?php

if (! function_exists('generate_breadcrumbs_from_url')) {
    function generate_breadcrumbs_from_url()
    {
        $segments = request()->segments();
        $breadcrumbs = [ ['label' => 'Inicio', 'url' => route('home')] ];

        $path = '';
        foreach ($segments as $i => $seg) {
            $path .= '/' . $seg;
            $label = ucfirst(str_replace(['-', '_'], ' ', $seg));

            // Si es el último segmento lo dejamos sin url
            if ($i === count($segments) - 1) {
                $breadcrumbs[] = ['label' => $label];
            } else {
                $breadcrumbs[] = ['label' => $label, 'url' => url($path)];
            }
        }
        return $breadcrumbs;
    }
}