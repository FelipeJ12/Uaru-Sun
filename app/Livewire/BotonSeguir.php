<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class BotonSeguir extends Component
{ public $userId;
    public $siguiendo;

    public function mount($userId)
{
    if (!Auth::check()) {
        abort(403, 'Debes iniciar sesión para ver esto.');
    }

    $this->userId = $userId;

    $this->siguiendo = Auth::user()
        ->siguiendo()
        ->where('seguido_id', $userId)
        ->exists();
}

    public function toggleSeguir()
    {
        $actual = Auth::user();

        if (!$actual) {
            abort(403, 'No hay usuario autenticado.');
        }

        $usuario = User::findOrFail($this->userId);

        if ($this->siguiendo) {
            $actual->siguiendo()->detach($usuario);
        } else {
            $actual->siguiendo()->attach($usuario);
        }

        $this->siguiendo = !$this->siguiendo;
    }

    public function render()
    {
        return view('livewire.boton-seguir');
    }
}
