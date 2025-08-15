@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Enfermedades de Plantas', 'url' => route('enfermedades.index')],
    ['label' => 'Ver Enfermedad']
];

$title = 'Ver Enfermedad en Planta'; 
@endphp
@extends('layouts.app')

@section('title', $enfermedad->nombre_enfermedad)

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $enfermedad->nombre_enfermedad }}</h1>
    </div>

    <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-center mb-4">
            @if($enfermedad->id <= 5)
                <img src="{{ asset($enfermedad->imagen) }}" 
                     alt="Imagen de {{ $enfermedad->nombre_enfermedad }}" 
                     style="width:566px; height:566px; object-fit:cover; border-radius:10px;">
            @else
                <img src="{{ asset('storage/' . $enfermedad->imagen) }}" 
                     alt="Imagen de {{ $enfermedad->nombre_enfermedad }}" 
                     style="width:566px; height:566px; object-fit:cover; border-radius:10px;">
            @endif
        </div>

        <div class="card-body">
            <h4 class="card-title text-primary">Planta</h4>
            <p>{{ $enfermedad->nombre_planta }}</p>

            <h4 class="card-title text-danger">Síntomas</h4>
            <p>{{ $enfermedad->sintomas }}</p>

            <h4 class="card-title text-warning">Causas</h4>
            <p>{{ $enfermedad->causas ?? 'No especificadas' }}</p>

            <h4 class="card-title text-success">Solución</h4>
            <p>{{ $enfermedad->solucion ?? 'No especificada' }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('enfermedades.index') }}" class="btn btn-secondary">Volver a la lista de enfermedades</a>
    </div>
</div>
@endsection
