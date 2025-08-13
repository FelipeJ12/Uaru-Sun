@php
    $title = 'Especies Anfibios'; 
@endphp

@extends('layouts.app')

@section('title', 'Especies de Anfibios')

@section('content')
    <div class="container">
    <style>
        .text-center {
            margin-top: 80px; /* Ajusta este valor según sea necesario */
        }
    </style>

    <div class="text-center mb-4">
    </div>

    <!-- Menú desplegable -->
    <div class="d-flex justify-content-end mb-4">
        <div class="dropdown">
            <button class="btn btn-success me-md-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Seleccionar Categoría
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('peligro.index') }}">Peligro de Extinción</a></li>
                <li><a class="dropdown-item" href="{{ route('anfibio.index') }}">Grupo de Anfibios</a></li>
                <li><a class="dropdown-item" href="{{ route('ave.index') }}">Grupo de Aves</a></li>
                <li><a class="dropdown-item" href="{{ route('mamiferos.index') }}">Grupo de Mamiferos</a></li>
                <li><a class="dropdown-item" href="{{ route('comidas.index') }}">Alimentación herbívoros</a></li>
                <li><a class="dropdown-item" href="{{ route('peligrosos.index') }}">Animales peligrosos</a></li>
            </ul>
        </div>
    </div>

        @if($especies->isEmpty())
            <p class="text-center" style="font-family: 'Roboto', sans-serif; color: rgb(242, 237, 244);">
                No hay especies registradas en la categoría de Anfibios.
            </p>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($especies as $especie)
                    <div class="col">
                        <div class="card h-100 shadow-lg">
                            @if($especie->image_path)
                                <img src="{{ asset('storage/' . $especie->image_path) }}" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover;" 
                                     alt="Imagen de {{ $especie->nombre }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="font-family: 'Roboto', sans-serif; color: #2c3e50;">
                                    {{ $especie->nombre }}
                                </h5>
                                <p class="card-text flex-grow-1" style="font-family: 'Roboto', sans-serif; color: #34495e;">
                                    <strong>Nombre Científico:</strong> {{ $especie->nombre_cientifico }}
                                </p>
                                <p class="card-text" style="font-family: 'Roboto', sans-serif; color: #34495e;">
                                    <strong>Hábitat:</strong> {{ $especie->habitat }}
                                </p>
                                <p class="card-text" style="font-family: 'Roboto', sans-serif; color: #34495e;">
                                    <strong>Ubicación:</strong> {{ $especie->ubicacion }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
