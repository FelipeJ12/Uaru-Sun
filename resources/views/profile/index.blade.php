@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container">


    <h1 style="color: white; text-align: center;">Mi Perfil</h1>

    <p style="color: white;"><strong>Nombre:</strong> {{ $user->name }}</p>
    <p style="color: white;"><strong>Email:</strong> {{ $user->email }}</p>

    <div style=" color: white;">
        <p><strong>Preferencias:</strong> {{ $user->datos->preferencias ?? 'Dato no disponible' }}</p>
        
        <p><strong>Alias:</strong> {{ $user->datos->alias ?? 'Dato no disponible' }}</p>
        <p><strong>Teléfono:</strong> {{ $user->datos->telefono ?? 'Dato no disponible' }}</p>
        <p><strong>Idiomas:</strong> {{ $user->datos->idiomas ?? 'Dato no disponible' }}</p>
        <p><strong>Deportes Favoritos:</strong> {{ $user->datos->deportes ?? 'Dato no disponible' }}</p>
        <p><strong>Animal Favorito:</strong> {{ $user->datos->animal_favorito ?? 'Dato no disponible' }}</p>
        <p><strong>Ocupación:</strong> {{ $user->datos->ocupacion ?? 'Dato no disponible' }}</p>
    </div>

<h2 style="color: white; text-align: center;">Mis Publicaciones</h2>

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .card {
            width: 18rem;
            margin: 10px;
            border: 2px solid #4CE4A0; /* Cambia el color y el grosor según tus necesidades */
            border-radius: 7px; /* Opcional: para esquinas redondeadas */
        }
    </style>


@if ($posts->count())

    <div class="card-container">
        <div class="card">
            <div class="card-body">
            <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
            </div>

        </div>

        <div class="card">
            <div class="card-body">
            <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
            <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
            </div>
        </div>
    </div>
@else
    <p style="color: white;">No tienes publicaciones aún.</p>
@endif

@endsection

