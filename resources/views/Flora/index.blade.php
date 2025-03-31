@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: white;" class="mb-4">Especies de Flora</h1>

        @if($especies->isEmpty())
            <p style="color: white;">No hay publicaciones registradas en la categoría de la flora.</p>
        @else
            <div class="row">
                @foreach($especies as $especie)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $especie->nombre }}</h5>
                                <p style="color: white;" class="card-text"><strong>Nombre Científico:</strong> {{ $especie->nombre_cientifico }}</p>
                                <p  style="color: white;" class="card-text"><strong>Hábitat:</strong> {{ $especie->habitat }}</p>
                                <p style="color: white;" class="card-text"><strong>Ubicación:</strong> {{ $especie->ubicacion }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection