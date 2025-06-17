<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function explorar(Request $request)
{
    $query = User::with('datos') // Asegura que la relación 'datos' venga cargada
                ->where('id', '!=', auth()->id());

     // Filtrar por nombre si se envía el parámetro
     if ($request->filled('nombre')) {
        $query->where('name', 'like', '%' . $request->nombre . '%');
    }

    $usuarios = $query->paginate(12); // o el número que uses

    // Ordenar por más seguidos o recientes
    if ($request->has('orden') && $request->orden === 'populares') {
        $query->withCount('seguidores')->orderBy('seguidores_count', 'desc');
    } else {
        $query->latest();
    }

    $usuarios = $query->paginate(12);

    // ⭐ Usuarios destacados (top 5 con más seguidores)
    $destacados = User::with(['datos'])
                    ->withCount('seguidores')
                    ->orderByDesc('seguidores_count')
                    ->take(5)
                    ->get();

    return view('usuarios.explorar', compact('usuarios', 'destacados'));
}


}
