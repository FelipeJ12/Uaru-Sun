@extends('layouts.app')
@section('content')
<div class="container text-white">

    <style>
        .text-center {
            margin-top: 80px;
        }
    </style>

    <!-- Usuarios Destacados -->
    <h2 class="text-center font-semibold text-2xl mb-6">Usuarios Destacados</h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px;">
        @foreach ($destacados as $usuario)
            @php
                $fotoPerfil = ($usuario->datos && $usuario->datos->foto_perfil && Storage::disk('public')->exists($usuario->datos->foto_perfil))
                    ? Storage::url($usuario->datos->foto_perfil)
                    : asset('images/usuario.jpg');

                $fotoPerfil .= '?' . ($usuario->datos && $usuario->datos->updated_at ? $usuario->datos->updated_at->timestamp : now()->timestamp);
            @endphp

            <div style="background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(4px); border-left: 4px solid #facc15; padding: 16px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center;">
                <img src="{{ $fotoPerfil }}" alt="Foto de perfil"
                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                <div style="flex: 1;">
                    <h3 style="font-size: 14px;">{{ $usuario->name }}</h3>
                    <p style="font-size: 12px;">{{ $usuario->seguidores_count }} seguidores</p>
                </div>
                @if (auth()->id() !== $usuario->id)
                    <div style="margin-left: 8px;">
                        @livewire('boton-seguir', ['userId' => $usuario->id], key('destacado-' . $usuario->id))
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Todos los Usuarios -->
    <h2 class="text-center font-semibold text-2xl mb-6 mt-10">Todos los Usuarios</h2>

    <!-- Filtro por nombre -->
    <form method="GET" action="{{ route('usuarios.explorar') }}" style="margin-bottom: 24px; display: flex; justify-content: center;">
        <input
            type="text"
            name="nombre"
            value="{{ request('nombre') }}"
            placeholder="Buscar por nombre..."
            style="width: 250px; padding: 6px; border-radius: 4px; border: 1px solid #ccc;"
        >
        <button type="submit" style="margin-left: 8px; padding: 6px 12px; background-color: #4f46e5; color: white; border: none; border-radius: 4px;">Buscar</button>
    </form>

    <!-- Cuadrícula más ancha -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; margin-top: 24px;">
        @foreach ($usuarios as $usuario)
            @php
                $fotoPerfil = ($usuario->datos && $usuario->datos->foto_perfil && Storage::disk('public')->exists($usuario->datos->foto_perfil))
                    ? Storage::url($usuario->datos->foto_perfil)
                    : asset('images/usuario.jpg');

                $fotoPerfil .= '?' . ($usuario->datos && $usuario->datos->updated_at ? $usuario->datos->updated_at->timestamp : now()->timestamp);
            @endphp

            <div style="background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(4px); border-radius: 12px; padding: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center;">
                <img src="{{ $fotoPerfil }}" alt="{{ $usuario->name }}"
                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 12px;">

                <div style="flex: 1;">
                    <h3 style="font-size: 14px; margin-bottom: 4px;">{{ $usuario->name }}</h3>
                    <p style="font-size: 12px; color: #e5e7eb; margin-bottom: 2px;">
                        {{ Str::limit($usuario->descripcion, 60) }}
                    </p>
                    <p style="font-size: 12px; color: #fef08a;">{{ $usuario->seguidores_count ?? 0 }} seguidores</p>
                </div>

                @if (auth()->id() !== $usuario->id)
                    <div style="margin-left: 8px;">
                        @livewire('boton-seguir', ['userId' => $usuario->id], key($usuario->id))
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div style="margin-top: 24px;">
        {{ $usuarios->links() }}
    </div>

</div>
@endsection
