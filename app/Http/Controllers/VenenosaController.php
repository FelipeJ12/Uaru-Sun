<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Models\Categoria;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class VenenosaController  extends Controller
{
    public function index()
    {
        $categoriaFauna = Subcategory::where('nombre', 'Venenosa')->first();

        $especies = Species::where('subcategory_id', optional($categoriaFauna)->id)->paginate(9);

        return view('veneno.venenosa', compact('especies'));
    }
}
