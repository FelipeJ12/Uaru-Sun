<?php

namespace App\Http\Controllers;

use App\Models\EnfermedadPlanta;
use Illuminate\Http\Request;

class EnfermedadPlantaController extends Controller
{
    public function index()
    {
        $enfermedades = EnfermedadPlanta::all();
        return view('enfermedades.index', compact('enfermedades'));
    }

    public function create()
    {
        return view('enfermedades.create');
    }

    public function store(Request $request)
    {
        // Validaciones
        $validated = $request->validate([
            'nombre_planta' => 'required|string|max:255',
            'nombre_enfermedad' => 'required|string|max:255',
            'sintomas' => 'required|string',
            'causas' => 'nullable|string',
            'solucion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nombre_planta.required' => 'El nombre de la planta es obligatorio.',
            'nombre_enfermedad.required' => 'El nombre de la enfermedad es obligatorio.',
            'sintomas.required' => 'Debe indicar los síntomas.',
            'solucion.required' => 'Debe indicar la solución.',
            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.mimes' => 'La imagen debe ser jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        // Guardar imagen si existe
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('enfermedades', 'public');
        }

        // Guardar en la base de datos
        EnfermedadPlanta::create($validated);

        return redirect()->route('enfermedades.index')->with('success', 'Enfermedad registrada exitosamente.');
    }
    public function show($id)
    {
        $enfermedad = EnfermedadPlanta::findOrFail($id);
        return view('enfermedades.show', compact('enfermedad'));
    }
    
    

    public function destroy($id)
{
    $enfermedad = EnfermedadPlanta::findOrFail($id);
    // Aquí puedes añadir validaciones extra, como permisos

    $enfermedad->delete();

    return redirect()->route('enfermedades.index')->with('success', 'Enfermedad eliminada correctamente.');
}
public function edit($id)
{
    $enfermedad = EnfermedadPlanta::findOrFail($id);
    return view('enfermedades.edit', compact('enfermedad'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nombre_planta' => 'required|string|max:255',
        'nombre_enfermedad' => 'required|string|max:255',
        'sintomas' => 'required|string',
        'causas' => 'nullable|string',
        'solucion' => 'required|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $enfermedad = EnfermedadPlanta::findOrFail($id);

    // Si viene una nueva imagen, guárdala y actualiza la ruta
    if ($request->hasFile('imagen')) {
        // Opcional: borrar la imagen anterior del almacenamiento si quieres
        $validated['imagen'] = $request->file('imagen')->store('enfermedades', 'public');
        $enfermedad->imagen = $validated['imagen'];
    }

    // Actualiza los demás campos
    $enfermedad->nombre_planta = $validated['nombre_planta'];
    $enfermedad->nombre_enfermedad = $validated['nombre_enfermedad'];
    $enfermedad->sintomas = $validated['sintomas'];
    $enfermedad->causas = $validated['causas'];
    $enfermedad->solucion = $validated['solucion'];

    $enfermedad->save();

    return redirect()->route('enfermedades.index')->with('success', 'Enfermedad actualizada exitosamente.');
}


}
