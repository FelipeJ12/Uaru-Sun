@extends('layouts.app')

@section('title', 'Mostrar Planta Medicinal')

@section('content')
    <div class="container my-5">
        <div class=" mb-4">
            <h1 class="display-5 text-success fw-bold">{{ $medicina->nombre_comun }}</h1>
            <p class="text-white fst-italic">{{ $medicina->nombre_cientifico }}</p>
        </div>
        <hr>

        <div class="card shadow-lg rounded-4 border-1">
            @if ($medicina->imagen)
                <img src="{{ asset('storage/' . $medicina->imagen) }}" class="card-img-top rounded-top-4" alt="Imagen de la planta" style="max-height: 400px; object-fit: cover;">
            @else
                <img src="{{ asset('img/sin_imagen.png') }}" class="card-img-top rounded-top-4" alt="Sin imagen disponible" style="max-height: 400px; object-fit: cover;">
            @endif

            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="text-success"><i class="fas fa-leaf me-2"></i>Usos Medicinales</h5>
                    <p class="card-text">{{ $medicina->usos_medicinales }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-success"><i class="fas fa-seedling me-2"></i>Parte Utilizada</h5>
                    <p class="card-text">{{ $medicina->parte_utilizada }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-success"><i class="fas fa-mortar-pestle me-2"></i>Forma de Uso</h5>
                    <p class="card-text">{{ $medicina->forma_de_uso }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Contraindicaciones</h5>
                    <p class="card-text">{{ $medicina->contraindicaciones }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('medicinas.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i>Volver a la lista de plantas
            </a>
        </div>
    </div>
@endsection
