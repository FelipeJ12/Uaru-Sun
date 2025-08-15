<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $registros = Bitacora::when($buscar, function($query) use ($buscar) {
            $query->where('usuario', 'like', "%$buscar%")
                  ->orWhere('accion', 'like', "%$buscar%");
        })->orderBy('fecha', 'desc')->get();

        return view('bitacora.bita', compact('registros'));
    }

    public function destroy($id)
    {
        $registro = Bitacora::findOrFail($id);
        $registro->delete();

        return redirect()->route('bitacora.index')
                         ->with('success', 'Registro eliminado correctamente.');
    }
}
