@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Mi Perfil', 'url' => route('profile.index')],
    ['label' => 'Mis Favoritos'] // Última miga
];
$title = 'Mis Favoritos'; 
@endphp

@extends('layouts.app')

@section('title', 'Mis Favoritos - Flora y Fauna de Honduras')

@section('content')
<div class="container mt-5">

    

    <h2 class="text-white text-center mb-4">Mis Favoritos</h2>

    <div class="row">
        @forelse($favoritos as $favorito)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                    <a href="{{ route('catalogo.show', $favorito->species->id) }}">
                        <img src="{{ asset('storage/' . $favorito->species->image_path) }}" 
                             alt="{{ $favorito->species->nombre }}"
                             class="card-img-top img-fluid" 
                             style="height: 250px; object-fit: cover; width: 100%;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $favorito->species->nombre }}</h5>
                        <p class="card-text"><em>{{ $favorito->species->nombre_cientifico }}</em></p>
                        @if ($favorito->species->category)
                            <span class="badge bg-success">
                                {{ $favorito->species->category->nombre }} ({{ $favorito->species->category->tipo }})
                            </span>
                        @else
                            <span class="badge bg-warning">Sin categoría</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center mt-5">
                <p class="text-white">No hay favoritos agregados.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #4CE4A0, #2DB07F);
    color: #fff;
    border: none;
    border-radius: 30px;
    font-weight: bold;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}
.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    text-decoration: none;
    color: #fff;
}
</style>
@endsection
