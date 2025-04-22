@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container">

<style>
    
    .text-center {
            margin-top: 80px; /* Ajusta este valor según sea necesario */
     }

    .custom-card {
        width: 100%;
        max-width: 250px;
        margin: auto;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        background-color: #fff;
        text-decoration: none;
    }

    .custom-card:hover {
        transform: scale(1.03);
    }

    .custom-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .custom-card-body {
        padding: 12px;
        text-align: center;
    }

    .custom-card-body h5 {
        font-size: 17px;
        margin-bottom: 6px;
    }

    .custom-card-body p {
        font-size: 14px;
        margin: 0;
    }

    .gallery-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
    }
</style>

    <!-- Título principal -->
    <h1 style="color: white; text-align: center; margin-top: 50px">Mi Perfil</h1>

    <!-- Contenedor de la información personal (dividido en dos columnas) -->
    <div class="perfil-container" style="display: flex; justify-content: space-between; margin-top: 30px;">
        
        <!-- Columna Izquierda -->
        <div class="columna" style="width: 48%;">
            <p style="color: white;"><strong>Nombre:</strong> {{ $user->name }}</p>
            <p style="color: white;"><strong>Email:</strong> {{ $user->email }}</p>
            <p style="color: white;"><strong>Preferencias:</strong> {{ $user->datos->preferencias ?? 'Dato no disponible' }}</p>
            <p style="color: white;"><strong>Alias:</strong> {{ $user->datos->alias ?? 'Dato no disponible' }}</p>
        </div>
        
        <!-- Columna Derecha -->
        <div class="columna" style="width: 48%;">
            <p style="color: white;"><strong>Teléfono:</strong> {{ $user->datos->telefono ?? 'Dato no disponible' }}</p>
            <p style="color: white;"><strong>Animal Favorito:</strong> {{ $user->datos->animal_favorito ?? 'Dato no disponible' }}</p>
            <p style="color: white;"><strong>Ocupación:</strong> {{ $user->datos->ocupacion ?? 'Dato no disponible' }}</p>
        </div>

    </div>

    <!-- Título de publicaciones -->

    <h2 style="color: white; text-align: center; margin-top: 30px;">Mis Publicaciones</h2>

    @if($especies->isEmpty())
        <p class="text-white">No hay especies registradas en este grupo.</p>
    @else
        <div class="gallery-grid">
            @foreach($especies as $especie)
                <a href="{{ route('catalogo.show', $especie->id) }}" class="custom-card text-dark">
                    <img src="{{ asset('storage/' . $especie->image_path) }}" alt="{{ $especie->nombre }}">
                    <div class="custom-card-body">
                        <h5>{{ $especie->nombre }}</h5>
                        <p><em>{{ $especie->nombre_cientifico }}</em></p>
                        <p><strong>Hábitat:</strong> {{ $especie->habitat }}</p>
                        <p><strong>Ubicación:</strong> {{ $especie->ubicacion }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif


</div>
@endsection
