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
       $validated = $request->validate([
    'nombre_planta'     => ['required','string','max:50','regex:/^[a-zA-Z0-9\s]+$/'],
    'nombre_enfermedad' => 'required|string|max:50',
    'sintomas' => ['required','string','max:150','regex:/^[A-Za-z0-9\s.,áéíóúÁÉÍÓÚñÑ]+$/'],
    'causas'            => 'nullable|string|max:150',
    'solucion'          => 'required|string|max:150',
    'imagen'            => 'nullable|image|mimes:jpeg,png,jpg,|max:2048',
], [
    'nombre_planta.required' => 'El nombre común es obligatorio.',
    'nombre_planta.max'      => 'Máximo 50 caracteres.',
    'nombre_planta.regex'    => 'El nombre común solo puede contener letras y números.',
]);


        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('enfermedades', 'public');
        }

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
    'nombre_planta'     => ['required','string','max:50','regex:/^[a-zA-Z0-9\s]+$/'],
    'nombre_enfermedad' => 'required|string|max:50',
    'sintomas' => ['required','string','max:150','regex:/^[A-Za-z0-9\s.,áéíóúÁÉÍÓÚñÑ]+$/'],
    'causas'            => 'nullable|string|max:150',
    'solucion'          => 'required|string|max:150',
    'imagen'            => 'nullable|image|mimes:jpeg,png,jpg,|max:2048',
], [
    'nombre_planta.required' => 'El nombre común es obligatorio.',
    'nombre_planta.max'      => 'Máximo 50 caracteres.',
    'nombre_planta.regex'    => 'El nombre común solo puede contener letras y números.',
    'sintomas.regex' => 'Los síntomas no pueden contener caracteres especiales.',
 
]);


        $enfermedad = EnfermedadPlanta::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('enfermedades', 'public');
        }

        $enfermedad->update($validated);

        return redirect()->route('enfermedades.index')->with('success', 'Enfermedad actualizada exitosamente.');
    }
}
