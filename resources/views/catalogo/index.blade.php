@php
    $title = 'Flora y Fauna'; 
@endphp

@extends('layouts.app')

@section('title', 'Catálogo de Especies')

@section('content')
<div class="container">
    <h1>Flora y Fauna de Honduras</h1>
    
    <div class="species-grid">
        @foreach($species as $specie)
        <a href="{{ route('species.show', $specie->id) }}" class="species-card">
            <img src="{{ asset('storage/public/especies' . $specie->image_path) }}" alt="{{ $specie->nombre }}">
            <h3>{{ $specie->nombre }}</h3>
        </a>
        @endforeach
    </div>

    {{ $species->links() }} <!-- Paginación -->
</div>
@endsection

<style>
.species-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px 0;
}

.species-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s;
}

.species-card:hover {
    transform: translateY(-5px);
}

.species-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.species-card h3 {
    padding: 15px;
    margin: 0;
    font-size: 1.1em;
    text-align: center;
    background: #f8f9fa;
}
</style>