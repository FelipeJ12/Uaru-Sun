@php
$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Fauna', 'url' => route('fauna.index')],
        ['label' => 'Animales Peligrosos','url' => route('peligrosos.index')],
        ['label' => 'Vista de Animales Peligrosos'] // Última miga
    ];
    $title = 'Vista Animales peligrosos'; 
@endphp

@extends('layouts.app')

@section('title', 'Mostrar Animal Peligroso')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $peligroso->nombre }}</h1>
        </div>

        <div class="card shadow-lg">
            <img src="{{ asset('storage/' . $peligroso->imagen) }}" class="card-img-top" alt="Imagen del {{ $peligroso->nombre }}" style="max-height: 400px; object-fit: cover;">

            <div class="card-body">
                <h4 class="card-title">Nombre Científico</h4>
                <p class="card-text">{{ $peligroso->nombre_cientifico }}</p>

                <h4 class="card-title">Descripción</h4>
                <p class="card-text">{{ $peligroso->descripcion }}</p>

                <h4 class="card-title">Hábitat</h4>
                <p class="card-text">{{ $peligroso->habitat }}</p>

                <h4 class="card-title">Ubicación</h4>
                <p class="card-text">{{ $peligroso->ubicacion }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('peligrosos.index') }}" class="btn btn-secondary">Volver a la lista de animales peligrosos</a>
        </div>
    </div>

@endsection
