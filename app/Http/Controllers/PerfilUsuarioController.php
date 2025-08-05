<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerfilUsuarioController extends Controller
{
    public function ver($id)
    {
        $usuario = User::with(['datos', 'publicaciones'])->withCount('seguidores')->findOrFail($id);

        return view('usuarios.perfil', compact('usuario'));

    }

    
}