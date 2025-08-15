<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flora;
use App\Models\Species;
use App\Models\Categoria;
use App\Models\Subcategory;

class PlantamedicinalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // // Buscar la categoría 'flora'
        $categoriaFlora = Subcategory::where('nombre', 'Medicinales')->first();
    
        // Obtener todas las especies que pertenecen a esta categoría
        $especies = Species::where('subcategory_id', optional($categoriaFlora)->id)->paginate(9);
    
            return view('plantamedicinal.plantamedicinal', compact('especies'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
