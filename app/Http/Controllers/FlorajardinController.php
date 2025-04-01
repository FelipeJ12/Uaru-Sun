<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlorajardinController extends Controller
{

    public function index()
    {
        
        // Buscar la categoría 'fauna'
        $categoriaFlora = Categoria::where('nombre', 'jardin')->first();
    
        // Obtener todas las especies que pertenecen a esta categoría
        $especies = Species::where('category_id', optional($categoriaFlora)->id)->get();
    
    
        // Retornar la vista con los datos
        return view('jardin.index', compact('especies'));
    }
    

}
