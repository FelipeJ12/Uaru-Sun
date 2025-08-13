@php
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

    <h2 style="color: white; text-align: center; margin-top: 30px;">Especies que te han gustado</h2>
    
    <div class="row">
        @forelse($likes as $like)
        <div class="col-md-4 mb-4">
            <div class="card species-card h-100 shadow-sm bg-dark text-white">
                <div class="image-wrapper">
                    <img src="{{ asset('storage/' . $like->species->image_path) }}" class="card-img-top species-img" alt="{{ $like->species->nombre }}">
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">{{ $like->species->nombre }}</h5>
                        <p class="card-text"><em>{{ $like->species->nombre_cientifico }}</em></p>
                    </div>
                    <a href="{{ route('catalogo.show', $like->species->id) }}" class="btn btn-primary mt-3">Ver más</a>
                </div>
            </div>
        </div>
        @empty
            <p style="color: white; text-align: center; margin-top: 30px;"> No has dado like a ninguna especie aún.</p>
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

    .species-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .image-wrapper {
        height: 250px;
        overflow: hidden;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .species-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection
