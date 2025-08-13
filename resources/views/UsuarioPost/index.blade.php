@php
    $title = 'Publicaciones de Usuario'; 
@endphp

@extends('layouts.app')

@section('title', 'Publicaciones de Usuario')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('UsuarioPost.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Especie
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre Común</th>
            </tr>
        </thead>
        <tbody>
            @foreach($species as $specie)
            <tr>
                <td><img src="{{ asset('storage/' . $specie->image_path) }}" width="80"></td>
                <td>{{ $specie->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $species->links() }}
</div>
@endsection