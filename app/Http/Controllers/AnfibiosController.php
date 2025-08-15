<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategory;
use App\Models\Species;

class AnfibiosController extends Controller
{
    public function index()
    {
        $categoriaFauna = Subcategory::where('nombre', 'Anfibios')->first();
        
        // Paginar los resultados
        $especies = Species::where('subcategory_id', optional($categoriaFauna)->id)->paginate(9);

        return view('anfibio.index', compact('especies'));
    }
}