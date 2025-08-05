@extends('layouts.app')

@section('title', 'Perfil de ' . $usuario->name)

@section('content')
<div class="container mx-auto px-4 py-8 text-white">

    {{-- IMPORTAR FONT AWESOME PARA ÍCONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .text-center {
            margin-top: 80px;
        }
        .avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background-color: #4CE4A0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px auto;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        }
        .custom-dark-card {
            background-color: #000;
            color: white;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        .custom-dark-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.2);
        }
    </style>

    <div class="text-center">
        <div class="avatar">
            @if($usuario->datos && $usuario->datos->foto_perfil)
                <img src="{{ asset('storage/' . $usuario->datos->foto_perfil) . '?t=' . time() }}" alt="Foto de perfil" />
            @else
                <img src="{{ asset('images/usuario.jpg') }}" alt="Foto por defecto" />
            @endif
        </div>
        <h2 class="text-2xl font-bold mt-4">{{ $usuario->name }}</h2>
    </div>

    {{-- Información básica pública (sin datos sensibles) --}}
    <div class="custom-dark-card p-4">
        <h3 class="text-xl font-semibold mb-4"><i class="fas fa-info-circle me-2"></i>Información básica</h3>
        <p><strong>Alias:</strong> {{ $usuario->datos->alias ?? 'No disponible' }}</p>
        <p><strong>Preferencias:</strong> {{ $usuario->datos->preferencias ?? 'No disponible' }}</p>
    </div>

    {{-- Publicaciones --}}
    <h3 class="text-xl font-semibold mb-4">Publicaciones</h3>

    @if($usuario->publicaciones->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($usuario->publicaciones as $publicacion)
                <div class="custom-dark-card p-4">
                    <h4 class="text-lg font-bold">{{ $publicacion->titulo }}</h4>
                    <p class="mt-2">{{ $publicacion->contenido }}</p>
                    <small class="text-gray-400">{{ $publicacion->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    @else
        <p>No hay publicaciones aún.</p>
    @endif

</div>
@endsection
