<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Species;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
// En el constructor del controlador:
public function __construct()
{
    $this->middleware('auth');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = Auth::user();
        $specie = Species::findOrFail($id);
        return view('comentarios.comentario_index', compact('specie', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string',
        ], [
            'comentario.required' => 'El comentario no puede estar vacío. Por favor, escribe algo antes de guardar.',
        ]);

        $comentario = new Comentario();
        $comentario->comentario = $request->input('comentario');
        $comentario->user_id = Auth::id(); // Aquí asignamos el usuario autenticado
        $comentario->species_id = $request->input('specie_id');
        $comentario->fecha = date('Y-m-d');

        if ($request->input('accion') == 'especie') {
            if ($comentario->save()) {
                $id = $comentario->species_id;
                $specie = Species::findOrFail($id);
                $user = Auth::user();
                return view('catalogo.show', compact('specie', 'user'));
            } else {
                return redirect()->route('comentarios.create', $comentario->species_id)->with('mensaje', 'Comentario no agregado.');
            }
        } else {
            if ($comentario->save()) {
                return redirect()->route('comentarios.create', $comentario->species_id)->with('mensaje', 'Comentario agregado.');
            } else {
                return redirect()->route('comentarios.create', $comentario->species_id)->with('mensaje', 'Comentario no agregado.');
            }
        }
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
  public function destroy(string $id, Request $request)
{
    $comentario = Comentario::findOrFail($id);
    $especie_id = $request->input('specie_id');
    $specie = Species::findOrFail($especie_id);

    if ($comentario->delete()) {
        return redirect()
            ->route('catalogo.show', $specie->id) // 👈 redirige a la publicación
            ->with('mensaje', 'Comentario borrado con éxito');
    } else {
        return redirect()
            ->route('catalogo.show', $specie->id)
            ->with('mensaje', 'Error, el comentario no fue borrado');
    }
}
}
