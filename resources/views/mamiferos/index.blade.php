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
    <h1 style="color: white; text-align: center; margin-top: 30px;">Bienvenido a la Sección Mamíferos</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('fauna.index') }}" class="btn btn-success me-md-2">Regresar</a>
    </div>


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