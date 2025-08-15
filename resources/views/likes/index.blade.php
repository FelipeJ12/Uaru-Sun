@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Mi Perfil', 'url' => route('profile.index')],
    ['label' => 'Mis Likes'] // Última miga
];
$title = 'Mis Likes'; 
@endphp

@extends('layouts.app')

@section('title', 'Mis Likes')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <a href="{{ route('profile.index') }}" class="btn-back">
            Regresar al perfil
        </a>
    </div>

    <h2 class="text-white text-center mt-4">Especies que te han gustado</h2>
    
    <div class="row mt-4">
        @forelse($likes as $like)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow bg-success bg-opacity-50 text-white position-relative rounded-4">
                    <a href="{{ route('catalogo.show', $like->species->id) }}">
                        <img src="{{ asset('storage/' . $like->species->image_path) }}" 
                             class="card-img-top img-fluid" 
                             style="height: 250px; object-fit: cover; width: 100%;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $like->species->nombre }}</h5>
                        <p class="card-text"><em>{{ $like->species->nombre_cientifico }}</em></p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-white text-center mt-4">No has dado like a ninguna especie aún.</p>
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
