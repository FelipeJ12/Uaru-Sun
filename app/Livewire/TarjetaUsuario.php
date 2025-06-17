<?php

namespace App\Livewire;

use Livewire\Component;

class TarjetaUsuario extends Component
{
    public $usuario;

    protected $listeners = ['seguidoresActualizados' => 'refreshUsuario'];

    public function mount(User $usuario)
    {
        $this->usuario = $usuario;
    }

    public function refreshUsuario()
    {
        $this->usuario = $this->usuario->fresh(); // Recarga el modelo desde la base de datos
    }

    public function render()
    {
        return view('livewire.tarjeta-usuario');
    }
}
