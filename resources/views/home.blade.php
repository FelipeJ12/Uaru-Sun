@extends('layouts.app')

@section('title', 'Inicio - Flora y Fauna de Honduras')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-3">
        <h1 class="display-5 text-success">
            <i class="fas fa-leaf"></i> Biodiversidad Hondureña
        </h1>
        <p class="lead text-white">Descubre nuestra riqueza natural</p>
    </div>

    <div class="kb-gallery-container">
        @foreach($species as $specie)
        <a href="{{ route('catalogo.show', $specie->id) }}" class="kb-gallery-item">
            <figure>
                <div class="img-wrapper">
                    <img src="{{ asset('storage/' . $specie->image_path) }}" alt="{{ $specie->nombre }}">
                </div>
                <figcaption>
                    <strong>{{ $specie->nombre }}</strong>
                    <em>{{ $specie->nombre_cientifico }}</em>
                    @if ($specie->category)
                        <span class="badge bg-success">
                            {{ $specie->category->nombre }} ({{ $specie->category->tipo }})
                        </span>
                    @else
                        <span class="badge bg-warning">Sin categoría</span>
                    @endif
                </figcaption>
            </figure>
        </a>
        @endforeach
    </div>

    <div class="pagination-container mt-4">
        {{ $species->links() }}
    </div>
</div>
@endsection

<style>
.kb-gallery-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 10px;
}

.kb-gallery-item {
    display: block;
    width: calc(24% - 20px);
    max-width: 350px;
    border-radius: 6px;
    overflow: hidden;
    text-decoration: none;
    background: #000;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    height: 400px;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.kb-gallery-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    z-index: 2;
}

.kb-gallery-item figure {
    margin: 0;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.img-wrapper {
    height: 280px; /* Fija el alto de la imagen */
    width: 100%;
    background-color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Recorta pero mantiene proporción */
    display: block;
}

figcaption {
    height: 120px;
    background-color: rgba(0, 0, 0, 0.85);
    color: white;
    padding: 10px;
    font-size: 0.9em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    gap: 5px;
}

figcaption strong,
figcaption em,
figcaption span {
    max-width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pagination-container {
    display: flex;
    justify-content: center;
}

.pagination .page-link {
    color: white;
    background: #198754;
    border: 1px solid #198754;
}

.pagination .page-link:hover {
    background: #145c39;
}

@media (max-width: 1024px) {
    .kb-gallery-item {
        width: calc(33.33% - 20px);
    }
}

@media (max-width: 768px) {
    .kb-gallery-item {
        width: calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .kb-gallery-item {
        width: 100%;
    }
}
</style>
