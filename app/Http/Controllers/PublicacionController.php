<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    // Mostrar todas las publicaciones
    public function index()
    {
        $publicaciones = Publicacion::all();
        return view('publicaciones.index', compact('publicaciones'));
    }

    // Mostrar una publicación específica
    public function show(Publicacion $publicacion)
    {
        return view('publicaciones.show', compact('publicacion'));
    }

    // Mostrar formulario para editar una publicación
    public function edit(Publicacion $publicacion)
    {
        return view('publicaciones.edit', compact('publicacion'));
    }

    // Actualizar una publicación
    public function update(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        $publicacion->update($request->all());

        return redirect()->route('publicaciones.index')->with('success', 'Publicación actualizada.');
    }

    // Eliminar una publicación
    public function destroy(Publicacion $publicacion)
    {
        $publicacion->delete();
        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada.');
    }
}
