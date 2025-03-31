@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container">


<h1 style="color: white; text-align: center;">Mi Perfil</h1>


        <p style="color: white;"><strong>Nombre:</strong> {{ $user->name }}</p>
        <p style="color: white;"><strong>Email:</strong> {{ $user->email }}</p>


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
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>{{ $post->title }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p style="color: white;">No tienes publicaciones aún.</p>
@endif
    
@endsection