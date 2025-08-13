@php
    $title = 'Vista Publicacion'; 
@endphp
@extends('layouts.app')

@section('title', $specie->nombre)

@section('content')
<div class="container" style="min-height: 80vh; margin-top: 40px;">
    <div class="row shadow-lg bg-white rounded-4 p-4" style="max-width: 1200px; margin: auto;">

        <!-- Columna izquierda: Detalles de la especie -->
        <div class="col-md-6 border-end">
            <div class="species-detail text-center">
                <img src="{{ asset('storage/' . $specie->image_path) }}" 
                     alt="{{ $specie->nombre }}" 
                     class="detail-image mb-3 shadow-sm">

                <div class="species-info text-start">
                    <h1 class="fw-bold">{{ $specie->nombre }}</h1>
                    <h2 class="fst-italic text-secondary">{{ $specie->nombre_cientifico }}</h2>

                    <!-- Botón de Favoritos -->
                    <div class="favorite-section">
                        @if(auth()->user() && auth()->user()->favoritos->where('species_id', $specie->id)->count())
                            <form action="{{ route('favoritos.destroy', $specie->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-star"></i> Quitar de Favoritos
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favoritos.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="species_id" value="{{ $specie->id }}">
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="far fa-star"></i> Añadir a Favoritos
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Botón de Me Gusta -->
                    <div class="like-section mb-3">
                        @if(auth()->check() && auth()->user()->likes->where('species_id', $specie->id)->count())
                            <form action="{{ route('likes.destroy', $specie->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" style="color: red; font-size: 28px;">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('likes.store') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="species_id" value="{{ $specie->id }}">
                                <button type="submit" class="btn btn-link p-0" style="color: gray; font-size: 28px;">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="info-section">
                        <h3>Hábitat</h3>
                        <p>{{ $specie->habitat }}</p>
                    </div>

                    <div class="info-section">
                        <h3>Descripción</h3>
                        <p>{{ $specie->descripcion }}</p>
                    </div>

                    <div class="location">
                        <h3>Ubicación en Honduras</h3>
                        <p>{{ $specie->location }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha: Comentarios -->
        <div class="col-md-6 d-flex flex-column">
            <h2 class="text-center fw-bold mb-3">Comentarios</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="comentarios-scroll flex-grow-1 overflow-auto mb-3 pe-2" style="max-height: 250px;">
                @forelse ($specie->comentarios->sortBy('id') as $comentario)
                    @php
                        $texto = $comentario->comentario;
                        $longitud_maxima = 58;
                        $texto_limitado = wordwrap($texto, $longitud_maxima, "\n", true);
                    @endphp
                    <div class="comentario-burbuja p-3 rounded-4 mb-2" style="background-color: #f8f9fa; border: 1px solid #ddd;">
                        <p class="mb-1 text-primary fw-bold">{{ $comentario->user->email }}</p>
                        <p class="mb-1 text-dark" style="white-space: pre-line;">{{ $texto_limitado }}</p>
                        <p class="mb-0 text-muted small">{{ date('d-m-Y', strtotime($comentario->fecha)) }}</p>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div class="text-end mt-2">
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$comentario->id}}">
                                        Eliminar
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="modal fade" id="modal{{$comentario->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Eliminar comentario</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea realmente eliminar el comentario "{{ $texto_limitado }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="specie_id" value="{{ $specie->id }}">
                                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                @empty
                    <p class="text-center text-muted">No se han agregado comentarios</p>
                @endforelse
            </div>

            <!-- Formulario de nuevo comentario -->
            <form action="{{ route('comentarios.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="comentario" id="comentario" maxlength="200" 
                              class="form-control @error('comentario') is-invalid @enderror" 
                              placeholder="Escribe un comentario..." style="resize: none; height: 80px;"></textarea>
                    @error('comentario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="specie_id" value="{{ $specie->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
                <input type="hidden" name="accion" value="especie">
                <button type="submit" class="btn btn-primary w-100">Comentar</button>
            </form>

            <!-- Botón regresar -->
            <div class="text-end mt-4">
            <a href="{{ session('previous_url', route('home')) }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Regresar
</a>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .detail-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
    }

    .info-section h3 {
        color: #27ae60;
        border-bottom: 2px solid #27ae60;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }
</style> 