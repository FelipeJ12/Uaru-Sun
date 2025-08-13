<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria; // Asegúrate de que esta línea esté aquí
use App\Models\Species; // Asegúrate de importar también el modelo Species si no lo has hecho


class AvesController extends Controller
{

    public function index()
    {
        // Buscar la categoría 'Anfibios'
        $categoriaFauna = Categoria::where('nombre', 'Grupo de Aves')->first();
    
        // Obtener todas las especies que pertenecen a esta categoría
        $especies = Species::where('category_id', optional($categoriaFauna)->id)->get();
    
        // Retornar la vista con los datos
        return view('aves.index', compact('especies'));

    
    }
   
}
