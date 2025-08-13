<?php

namespace App\Http\Controllers;

use App\Models\Fauna;
use App\Models\Species;
use App\Models\Categoria;
use Illuminate\Http\Request;

class FaunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Categorías que quieres mostrar
    $categoriasFiltrar = [
        'Mamiferos',
        'Peligro de Extincion',
        'Anfibios',
        'Grupo de Aves',
        
    ];

    // Obtener IDs de esas categorías
    $categoriasIds = Categoria::whereIn('nombre', $categoriasFiltrar)->pluck('id');

    // Filtrar especies que tengan uno de esos category_id
    $especies = Species::whereIn('category_id', $categoriasIds)->paginate(8);

    return view('Fauna.index', compact('especies'));
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
