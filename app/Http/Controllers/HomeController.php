<?php

namespace App\Http\Controllers;

use App\Models\Species; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // Obtener especies con sus categorías
    $species = Species::with('category') // Esto debe coincidir con el nombre en el modelo
              ->latest()
              ->take(6)
              ->get();


    return view('home', compact('species'));
}
}