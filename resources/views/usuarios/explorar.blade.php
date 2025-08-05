@extends('layouts.app')

@section('content')
<div class="container text-white">

    <style>
        .text-center {
            margin-top: 80px;
        }

        .card-user {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(6px);
            border-left: 4px solid #facc15;
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            transition: transform 0.2s;
        }

        .card-user:hover {
            transform: scale(1.02);
        }

        .card-user img {
            width: 55px;
            height: 55px;
            border-radius: 9999px;
            object-fit: cover;
            margin-right: 14px;
            border: 2px solid #fef3c7;
        }

        .card-user h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #fff;
        }

        .card-user p {
            font-size: 13px;
            color: #e5e7eb;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .grid-wide {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }

        .btn-buscar {
            padding: 10px 20px;
            background: linear-gradient(90deg, #facc15, #eab308);
            color: #1f2937; /* gris oscuro para buen contraste */
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(250, 204, 21, 0.4);
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.15s ease;
            margin-left: 8px; /* separación del input */
        }

        .btn-buscar:hover {
            background: linear-gradient(90deg, #eab308, #ca8a04);
            box-shadow: 0 6px 14px rgba(234, 179, 8, 0.6);
            transform: translateY(-2px);
        }

        .btn-buscar:active {
            transform: translateY(0);
            box-shadow: 0 3px 6px rgba(234, 179, 8, 0.4);
        }

        .form-input {
            width: 250px;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
    </style>

    <!-- Usuarios Destacados -->
    <h2 class="text-center font-semibold text-3xl mb-8">Usuarios Destacados</h2>

    <div class="grid-container">
        @foreach ($destacados as $usuario)
            @php
                $fotoPerfil = ($usuario->datos && $usuario->datos->foto_perfil && Storage::disk('public')->exists($usuario->datos->foto_perfil))
                    ? Storage::url($usuario->datos->foto_perfil)
                    : asset('images/usuario.jpg');
                $fotoPerfil .= '?' . ($usuario->datos && $usuario->datos->updated_at ? $usuario->datos->updated_at->timestamp : now()->timestamp);
            @endphp

            <div class="card-user">
                <img src="{{ $fotoPerfil }}" alt="Foto de perfil">
                <div style="flex: 1;">
                    <h3>
                        <a href="{{ route('usuario.perfil', $usuario->id) }}" style="color: #facc15; text-decoration: none;">
                            {{ $usuario->name }}
                        </a>
                    </h3>
                    <p>{{ $usuario->seguidores_count }} seguidores</p>
                </div>
                @if (auth()->id() !== $usuario->id)
                    <div style="margin-left: 8px;">
                        <livewire:boton-seguir :user-id="$usuario->id" :wire:key="'destacado-'.$usuario->id" />
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Todos los Usuarios -->
    <h2 class="text-center font-semibold text-3xl mt-14 mb-8">Todos los Usuarios</h2>

    <!-- Filtro por nombre -->
    <form method="GET" action="{{ route('usuarios.explorar') }}" style="margin-bottom: 24px; display: flex; justify-content: center; align-items: center;">
        <input
            type="text"
            name="nombre"
            value="{{ request('nombre') }}"
            placeholder="Buscar por nombre..."
            class="form-input"
        >
        <button type="submit" class="btn-buscar">Buscar</button>
    </form>

    <!-- Cuadrícula más ancha -->
    <div class="grid-container grid-wide">
        @foreach ($usuarios as $usuario)
            @php
                $fotoPerfil = ($usuario->datos && $usuario->datos->foto_perfil && Storage::disk('public')->exists($usuario->datos->foto_perfil))
                    ? Storage::url($usuario->datos->foto_perfil)
                    : asset('images/usuario.jpg');
                $fotoPerfil .= '?' . ($usuario->datos && $usuario->datos->updated_at ? $usuario->datos->updated_at->timestamp : now()->timestamp);
            @endphp

            <div class="card-user">
                <img src="{{ $fotoPerfil }}" alt="{{ $usuario->name }}">
                <div style="flex: 1;">
                    <h3>
                        <a href="{{ route('usuario.perfil', $usuario->id) }}" style="color: #facc15; text-decoration: none;">
                            {{ $usuario->name }}
                        </a>
                    </h3>
                    <p>{{ Str::limit($usuario->descripcion, 60) }}</p>
                    <p style="color: #fde68a;">{{ $usuario->seguidores_count ?? 0 }} seguidores</p>
                </div>
                @if (auth()->id() !== $usuario->id)
                    <div style="margin-left: 8px;">
                        <livewire:boton-seguir :user-id="$usuario->id" :wire:key="$usuario->id" />
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="pagination">
        {{ $usuarios->links() }}
    </div>

</div>
@endsection
