<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Models\Categoria;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminSpeciesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $filtro = $request->input('filtro');

        if ($filtro === 'nombre_comun') {
            $species = Species::where('nombre', 'like', "%$query%")->paginate(10);
        } elseif ($filtro === 'habitat') {
            $species = Species::where('habitat', 'like', "%$query%")->paginate(10);
        } else {
            $species = Species::paginate(10);
        }

        return view('admin.especies.index', compact('species', 'query'));
    }

    public function create()
{
    $categories = Categoria::all();
    $subcategories = Subcategory::all();
    return view('admin.especies.create', compact('categories', 'subcategories'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'nombre_cientifico' => 'required|max:255',
            'descripcion' => 'required',
            'habitat' => 'required',
            'location' => 'required',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
        ]);

        $imagePath = $request->file('image')->store('especies', 'public');

        Species::create([
            'nombre' => $validated['nombre'],
            'nombre_cientifico' => $validated['nombre_cientifico'],
            'descripcion' => $validated['descripcion'],
            'habitat' => $validated['habitat'],
            'location' => $validated['location'],
            'image_path' => $imagePath,
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.especies.index')->with('success', '¡Especie creada!');
    }

    public function edit(Species $species)
    {
        $categories = Categoria::all();
        $subcategories = Subcategory::all();
        return view('admin.especies.edit', compact('species', 'categories', 'subcategories'));
    }

    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'nombre_cientifico' => 'required|max:255',
            'descripcion' => 'required',
            'habitat' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($species->image_path);
            $validated['image_path'] = $request->file('image')->store('especies', 'public');
        }

        $species->update($validated);

        return redirect()->route('admin.especies.index')->with('success', '¡Especie actualizada!');
    }

    public function destroy(Species $species)
    {
        Storage::disk('public')->delete($species->image_path);
        $species->delete();

        return redirect()->route('admin.especies.index')->with('success', '¡Publicación eliminada!');
    }
}