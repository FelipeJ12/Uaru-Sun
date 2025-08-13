@php
    $title = 'Mis Favoritos '; 
@endphp

@extends('layouts.app')

@section('title', 'Mis Favoritos - Flora y Fauna de Honduras')

@section('content')
<div class="container mt-5">

    {{-- Botón estilizado de regreso al perfil --}}
    <div class="mb-4">
        <a href="{{ route('profile.index') }}" class="btn-back">
            Regresar al perfil
        </a>
    </div>

    <h2 class="text-white text-center mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-family: 'Arial', sans-serif;">Mis Favoritos</h2>

    <div class="kb-gallery-container">
        @foreach($favoritos as $favorito)
        <a href="{{ route('catalogo.show', $favorito->species->id) }}" class="kb-gallery-item">
            <img src="{{ asset('storage/' . $favorito->species->image_path) }}" alt="{{ $favorito->species->nombre }}">
            <figcaption>
                <strong>{{ $favorito->species->nombre }}</strong>
                <br>
                <em>{{ $favorito->species->nombre_cientifico }}</em>
                @if ($favorito->species->category)
                    <span class="badge bg-success">
                        {{ $favorito->species->category->nombre }} ({{ $favorito->species->category->tipo }})
                    </span>
                @else
                    <span class="badge bg-warning">Sin categoría</span>
                @endif
            </figcaption>
        </a>
        @endforeach
    </div>

    @if($favoritos->isEmpty())
    <div class="text-center mt-5">
        <p class="text-white">No hay favoritos agregados.</p>
    </div>
    @endif

</div>
@endsection

<style>
/* Contenedor de galería */
.kb-gallery-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    padding: 20px 0;
}

/* Elementos individuales */
.kb-gallery-item {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: calc(25% - 15px);
    max-width: 300px;
    border-radius: 8px;
    overflow: hidden;
    text-decoration: none;
    background-color: #000;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

/* Imagen de la especie */
.kb-gallery-item img {
    width: 100%;
    height: auto;
    aspect-ratio: 16/9;
    object-fit: cover;
    transition: transform 0.3s ease-in-out;
}

.kb-gallery-item:hover img {
    transform: scale(1.05);
}

/* Texto debajo de la imagen */
.kb-gallery-item figcaption {
    text-align: center;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 10px;
    font-size: 0.9em;
    width: 100%;
}

/* Botón de regresar */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #4CE4A0, #2DB07F);
    color: #fff;
    border: none;
    border-radius: 30px;
    font-weight: bold;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    text-decoration: none;
    color: #fff;
}
</style>
