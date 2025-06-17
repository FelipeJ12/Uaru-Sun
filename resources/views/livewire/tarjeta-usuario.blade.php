<div style="...">
    <img src="{{ $usuario->foto_perfil_url }}" ...>

    <div style="flex: 1;">
        <h3>{{ $usuario->name }}</h3>
        <p>{{ Str::limit($usuario->descripcion, 60) }}</p>
        <p>{{ $usuario->seguidores_count }} seguidores</p>
    </div>

    @if (auth()->id() !== $usuario->id)
        <livewire:boton-seguir :userId="$usuario->id" wire:key="'boton-' . $usuario->id" />
    @endif
</div>