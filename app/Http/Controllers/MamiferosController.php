<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

use App\Models\Categoria; // Asegúrate de que esta línea esté aquí
use App\Models\Species; // Asegúrate de importar también el modelo Species si no lo has hecho


class MamiferosController extends Controller
{
    public function index()
    {
        // Buscar la categoría 'Anfibios'
        $categoriaFauna = Subcategory::where('nombre', 'Mamiferos')->first();
    
        // Obtener todas las especies que pertenecen a esta categoría
        $especies = Species::where('subcategory_id', optional($categoriaFauna)->id)->paginate(9);
    
        // Retornar la vista con los datos
        return view('mamiferos.index', compact('especies'));
    }
}
