<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Models\Categoria;
use App\Models\Subcategory;
use Illuminate\Http\Request;


class ArbolesController extends Controller
{
    public function index()
    {
        // Buscar la categoría 'fauna'
        $categoriaFlora = Subcategory::where('nombre', 'Arboles')->first();
    
        // Obtener todas las especies que pertenecen a esta categoría
        $especies = Species::where('subcategory_id', optional($categoriaFlora)->id)->paginate(9);
    
    
        // Retornar la vista con los datos
        return view('arboles.index', compact('especies'));
    }
}
