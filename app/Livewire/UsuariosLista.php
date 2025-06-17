<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UsuariosLista extends Component
{
    public function render()
    {
        $usuarios = User::where('id', '!=', auth()->id())->get();

        return view('livewire.usuarios-lista', compact('usuarios'));
    }
}
