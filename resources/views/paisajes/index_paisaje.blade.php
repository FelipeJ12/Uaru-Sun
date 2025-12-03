@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Paisajes'] // Última miga
];
$title = 'Paisajes Naturales'; 
@endphp

@extends('layouts.app')

@section('title', 'Administrar Paisajes')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Cambiamos la variable de paisajes a especies --}}
        @foreach($especies as $especie) 
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                    {{-- Usamos la ruta y el ID del modelo Especie --}}
                    <a href="{{ route('paisajes.show', $especie->id) }}">
                        @php
                            $imagenPath = file_exists(public_path('storage/' . $especie->url)) 
                                ? asset('storage/' . $especie->url) 
                                : asset('images/default-paisaje.jpg'); // imagen por defecto si no existe
                        @endphp
                        <img src="{{ $imagenPath }}" class="card-img-top img-fluid" style="height: 250px; object-fit: cover; width: 100%;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $especie->nombres }}</h5>
                        <p class="card-text">{{ $especie->descripcion }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $especies->links() }}
    </div>
</div>
@endsection