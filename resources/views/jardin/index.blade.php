@extends('layouts.app')

@section('content')
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

<div class="container mt-4">
    <h1 style="color: white; text-align: center; margin-top: 30px;">Bienvenido a la Flora de Jardín</h1>

     <!-- Menú desplegable -->
     <div class="d-flex justify-content-end mb-4">
        <div class="dropdown">
            <button class="btn btn-success me-md-2"  type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Seleccionar Categoría
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('agricola.index') }}">Flora Agricola</a></li>
                <li><a class="dropdown-item" href="{{ route('jardin.index') }}">Flora de Jardin</a></li>
                <li><a class="dropdown-item" href="{{ route('arboles.index') }}">Grupo de Árboles</a></li>
            </ul>
        </div>
    </div>

    @if($especies->isEmpty())
        <p style="color: white; text-align: center; margin-top: 30px;">No hay especies registradas en este grupo.</p>
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