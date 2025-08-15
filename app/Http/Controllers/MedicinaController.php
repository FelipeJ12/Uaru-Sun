<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;
use App\Models\Medicina;
use Illuminate\Http\Request;

class MedicinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

     $categoriaFlora = Subcategory::where('nombre', 'medicibas')->first();

     

        $medicinas = Medicina::Paginate(10);
        return view('medicinales.medicinal_index', compact('medicinas'));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicinales.medicinal_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_comun' => 'required|string|max:100',
            'nombre_cientifico' => 'required|string|max:150',
            'usos_medicinales' => 'required|string',
            'parte_utilizada' => 'required|string|max:100',
            'forma_de_uso' => 'required|string',
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'contraindicaciones' => 'required|string|max:255',
        ], [
            'nombre_comun.required' => 'El nombre común es obligatorio.',
            'nombre_cientifico.required' => 'El nombre científico es obligatorio.',
            'usos_medicinales.required' => 'Los usos medicinales son obligatorios.',
            'parte_utilizada.required' => 'La parte utilizada es obligatoria.',
            'forma_de_uso.required' => 'La forma de uso es obligatoria.',
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.mimes' => 'La imagen debe ser JPG o PNG.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
            'contraindicaciones.required' => 'Las contraindicaciones son obligatorias.',
        ]);

        $medicina = new Medicina();
        $medicina->nombre_comun = $request->input('nombre_comun');
        $medicina->nombre_cientifico = $request->input('nombre_cientifico');
        $medicina->usos_medicinales = $request->input('usos_medicinales');
        $medicina->parte_utilizada = $request->input('parte_utilizada');
        $medicina->forma_de_uso = $request->input('forma_de_uso');
        $medicina->contraindicaciones = $request->input('contraindicaciones');

        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('imagenes_medicinas', 'public');
            $medicina->imagen = $ruta;
        }

        $medicina->save();

        return redirect()->route('medicinas.index')->with('success', 'Medicina registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medicina = Medicina::findOrfail($id);
        return view('medicinales.medicinal_show', compact('medicina'));
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
