<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Models\Categoria;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class PeligroExtincionController extends Controller
{
    public function index()
    {
        // Buscar la categoría 'Peligro de extincion'
        $categoriaFauna = Subcategory::where('nombre', 'Peligro de Extincion')->first();

        // Obtener todas las especies paginadas que pertenecen a esta categoría
        $especies = Species::where('subcategory_id', optional($categoriaFauna)->id)->paginate(9);

        // Retornar la vista con los datos
        return view('peligro.index', compact('especies'));
    }
}
