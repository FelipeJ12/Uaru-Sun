<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Categoria; // Asegúrate de que esta línea esté aquí
use App\Models\Species; // Asegúrate de importar también el modelo Species si no lo has hecho


class FloraagricolaController extends Controller
{
    public function index()
    {
        // Buscar la categoría 'fauna'
        $categoriaFlora = Subcategory::where('nombre', 'Agricola')->first();
    
        // Obtener todas las especies que pertenecen a esta categoría
        $especies = Species::where('subcategory_id', optional($categoriaFlora)->id)->paginate(9);
    
    
        // Retornar la vista con los datos
        return view('agricola.index', compact('especies'));
    }
}
