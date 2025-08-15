<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Species;
use App\Models\Categoria;
use App\Models\Subcategory;
use App\Models\flora;




class FloraController extends Controller
{
   /**
 * Display a listing of the resource.
 */
public function index()
{
    // Categorías que quieres mostrar
    $categoriasFiltrar = [
        'Arboles',
        'Medicinales',
        'Agricola',
        'Venenosa',
        'Comestible',
        
    ];

    // Obtener IDs de esas categorías
    $categoriasIds = Subcategory::whereIn('nombre', $categoriasFiltrar)->pluck('id');

    // Filtrar especies que tengan uno de esos category_id
    $especies = Species::whereIn('subcategory_id', $categoriasIds)->paginate(8);

    return view('flora.index', compact('especies'));
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
