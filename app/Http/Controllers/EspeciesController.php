<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\Breadcrumbs;

class EspeciesController extends Controller
{
    public function index(Request $request)
{
    $query = Species::query();

    if ($request->has('search')) {
        $query->where('nombre', 'like', '%'.$request->search.'%')
              ->orWhere('nombre_cientifico', 'like', '%'.$request->search.'%');
    }

    $species = $query->paginate(12);
    return view('catalogo.index', compact('species'));
}

    public function show(Request $request, $id)
    {
        $specie = Species::findOrFail($id);
         // $title sirve para reemplazar el último segmento (id) en el breadcrumb automático
    $title = $specie->nombre; // o el campo que uses
    // Genera breadcrumbs automáticos
    $breadcrumbItems = Breadcrumbs::build($request, $specie->nombre);
        $user = Auth::user();
        return view('catalogo.show', compact('specie', 'user','title'));
    }

    public function destroy($id)
{
    $specie = Species::findOrFail($id);

    // Verificar si el usuario tiene permiso para eliminar
    if (!auth()->user()->can('delete-species')) {
        return redirect()->route('admin.especies.index')->with('error', 'No tienes permiso para eliminar esta especie.');
    }

    $specie->delete();

    return redirect()->route('admin.especies.index')->with('success', 'Especie eliminada exitosamente.');
}

}
