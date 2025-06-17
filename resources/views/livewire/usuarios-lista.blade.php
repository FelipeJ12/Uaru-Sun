<div>
<div wire:poll.10s> {{-- Actualiza cada 10 segundos --}}
    <h2 class="text-xl font-bold mb-4">Explorar Usuarios</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($usuarios as $usuario)
            <div class="bg-white p-4 rounded shadow text-center">
                <img src="{{ $usuario->profile_photo_url }}" class="w-16 h-16 rounded-full mx-auto">
                <h3 class="mt-2 font-semibold">{{ $usuario->name }}</h3>
                <p class="text-sm text-gray-600">{{ Str::limit($usuario->descripcion, 50) }}</p>

                @if (auth()->id() !== $usuario->id)
                    @livewire('boton-seguir', ['userId' => $usuario->id], key('poll-'.$usuario->id))
                @endif
            </div>
        @endforeach
    </div>
</div>

</div>
