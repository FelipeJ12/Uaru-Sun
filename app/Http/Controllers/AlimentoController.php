<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlimentoController extends Controller
{
    public function index()
    {
        return view('comidas.index_herbivoro');
    }
}
