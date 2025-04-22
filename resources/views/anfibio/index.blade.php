@extends('layouts.app')

@section('title', 'Especies de Anfibios')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center" style="font-family: 'Roboto', sans-serif; color: rgb(233, 238, 244);">
            Tipo de especies Anfibios
        </h1>

    @if($especies->isEmpty())
        <p class="text-white text-center">No hay especies registradas en los animales anfibios.</p>
    @else
        <div class="kb-gallery-container">
            @foreach($especies as $especie)
            <a href="{{ route('catalogo.show', $especie->id) }}" class="kb-gallery-item">
                <figure>
                    <div class="img-wrapper">
                        <img src="{{ asset('storage/' . $especie->image_path) }}" alt="{{ $especie->nombre }}">
                    </div>
                    <figcaption>
                        <strong>{{ $especie->nombre }}</strong>
                        <em>{{ $especie->nombre_cientifico }}</em>
                        <span><strong>Hábitat:</strong> {{ $especie->habitat }}</span>
                        <span><strong>Ubicación:</strong> {{ $especie->ubicacion }}</span>
                        @if ($especie->category)
                            <span class="badge bg-success">
                                {{ $especie->category->nombre }} ({{ $especie->category->tipo }})
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
            {{ $especies->links() }}
        </div>
    @endif
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
    height: 280px;
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
    object-fit: cover;
    display: block;
}

figcaption {
    height: 120px;
    background-color: rgba(0, 0, 0, 0.85);
    color: white;
    padding: 10px;
    font-size: 0.85em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    gap: 4px;
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
