@extends('layouts.app')

@section('title', 'Mostrar Paisaje')

@section('content')
<div class="mb-3 text-white">
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $paisaje->nombres }}</h1>
    </div>

    <div class="card shadow-lg">
        @if($paisaje->id <= 5)
            <img src="{{ asset($paisaje->url) }}" class="card-img-top" alt="Imagen del Paisaje" style="max-height: 400px; object-fit: cover;">
        @else
            <img src="{{ asset('storage/' . $paisaje->url) }}" class="card-img-top" alt="Imagen del Paisaje" style="max-height: 400px; object-fit: cover;">
        @endif

        <div class="card-body">
            <h4 class="card-title text-primary">Descripción</h4>
            <p class="card-text">{{ $paisaje->descripcion }}</p>

            <h4 class="card-title text-success">Flora</h4>
            <ul>
                @foreach ($paisaje->ecosistemas as $ecosistema)
                    @if ($ecosistema->tipo == 'Flora')
                        <li>{{ $ecosistema->nombre }}</li>
                    @endif
                @endforeach
            </ul>

            <h4 class="card-title text-success">Fauna</h4>
            <ul>
                @foreach ($paisaje->ecosistemas as $ecosistema)
                    @if ($ecosistema->tipo == 'Fauna')
                        <li>{{ $ecosistema->nombre }}</li>
                    @endif
                @endforeach
            </ul>

            <h4 class="card-title text-warning">Ubicación</h4>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="{{$paisaje->ubicacion}}" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('paisajes.index') }}" class="btn btn-secondary">Volver a la lista de paisajes</a>
    </div>
</div>

@endsection
