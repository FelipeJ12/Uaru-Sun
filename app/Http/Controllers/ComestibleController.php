<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Subcategory;


class ComestibleController  extends Controller
{
    public function index()
    {
        $categoriaFlora = Subcategory::where('nombre', 'comestible')->first();

        $especies = Species::where('subcategory_id', optional($categoriaFlora)->id)->paginate(9);

        return view('comestible.comestible', compact('especies'));
    }
}
