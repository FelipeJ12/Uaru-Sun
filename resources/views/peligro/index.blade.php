@extends('layouts.app')

@section('content')
    <div class="container">
    <style>
        .text-center {
            margin-top: 80px; /* Ajusta este valor según sea necesario */
        }
    </style>

    <div class="text-center mb-4">
        <h1 class="mb-4 text-white" class="display-4 text-success">
            <i style="color: white; text-align: center;"></i> Especies en Peligro de Extinción
        </h1>
    </div>


    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('fauna.index') }}" class="btn btn-success me-md-2">Regresar</a>
    </div>

        @if($especies->isEmpty())
            <p class="text-white">No hay especies registradas en los animales en peligro de extincion.</p>
        @else
            <div class="row">
                @foreach($especies as $especie)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-primary">{{ $especie->nombre }}</h5>
                                <p class="card-text text-success"><strong>Nombre Científico:</strong> {{ $especie->nombre_cientifico }}</p>
                                <p class="card-text text-danger"><strong>Hábitat:</strong> {{ $especie->habitat }}</p>
                                <p class="card-text text-purple"><strong>Ubicación:</strong> {{ $especie->ubicacion }}</p>
                                <div class="mt-auto text-center">
                                    <img src="{{ asset('storage/' . $especie->image_path) }}" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
