@php
$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Administrar Especies', 'url' => route('admin.especies.index')],
        ['label' => 'Comentarios de la especie '] // Última miga
    ];

    $title = 'Comentarios'; 
@endphp

@extends('layouts.app')

@section('title', 'Comentarios')

@section('content')
<style>
    body {
        background-image: url('{{ asset('images/fonds.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #333;
    }

    .comentarios-wrapper {
        max-width: 600px;
        margin: 50px auto;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 25px 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    h1 {
        font-size: 2rem;
        text-align: center;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 25px;
    }

    /* Imagen de especie cuadrada */
    .imagen-especie {
        width: 10cm;
        height: 10cm;
        object-fit: cover;
        border-radius: 10px;
        display: block;
        margin: 0 auto 20px auto;
    }

    .alert-success {
        text-align: center;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        margin-bottom: 20px;
    }

    .comentario-burbuja {
        background-color: #f9f9f9;
        padding: 15px 20px;
        border-radius: 25px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        position: relative;
        margin-bottom: 15px;
        word-wrap: break-word;
    }

    .comentario-burbuja p:first-child {
        font-weight: 700;
        color: #1877f2;
        margin-bottom: 8px;
    }

    .comentario-burbuja p:nth-child(2) {
        margin-bottom: 10px;
        white-space: pre-wrap;
        color: #222;
    }

    .comentario-fecha {
        font-size: 0.75rem;
        color: #6c757d;
        position: absolute;
        bottom: 10px;
        right: 20px;
    }

    .btn-eliminar {
        background-color: transparent;
        border: none;
        color: #ff4d4d;
        font-weight: 600;
        cursor: pointer;
        font-size: 0.85rem;
        padding: 0;
        margin-left: auto;
        transition: color 0.3s ease;
    }

    .btn-eliminar:hover {
        color: #cc0000;
        text-decoration: underline;
    }

    .comentario-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        position: relative;
    }

    .comentarios-form textarea {
        width: 100%;
        border-radius: 20px;
        border: 1px solid #ccc;
        padding: 12px 20px;
        font-size: 1rem;
        resize: none;
        transition: border-color 0.3s ease;
    }

    .comentarios-form textarea:focus {
        border-color: #28a745;
        outline: none;
        box-shadow: 0 0 6px rgba(40,167,69,0.5);
    }

    .comentarios-form button {
        margin-top: 15px;
        width: 100%;
        padding: 12px 0;
        border-radius: 25px;
        border: none;
        background-color: #1877f2;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .comentarios-form button:hover {
        background-color: #145dbf;
    }

    .comentario-vacio {
        text-align: center;
        color: #888;
        font-style: italic;
        padding: 25px 0;
    }

    .btn-secondary {
        display: block;
        width: 100%;
        margin-top: 30px;
        padding: 12px 0;
        border-radius: 25px;
        background-color: #6c757d;
        border: none;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #565e64;
        text-decoration: none;
        color: white;
    }
</style>

<div class="comentarios-wrapper">
    <h1 class="text-black">Comentarios de la especie {{ $specie->nombre }}</h1>

    <!-- Imagen de la especie -->
    @if($specie->image_path)
        <img src="{{ asset('storage/' . $specie->image_path) }}" alt="{{ $specie->nombre }}" class="imagen-especie">
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($specie->comentarios->isEmpty())
        <div class="comentario-vacio">No se han agregado comentarios</div>
    @else
        @foreach ($specie->comentarios->sortBy('id') as $comentario)
            @if($comentario->comentario)
                @php
                    $texto = wordwrap($comentario->comentario, 58, "\n", true);
                @endphp
                <div class="comentario-item">
                    <div class="comentario-burbuja">
                        <p>{{ $comentario->user->email }}</p>
                        <p>{{ $texto }}</p>
                        <div class="comentario-fecha">{{ date('d-m-Y', strtotime($comentario->fecha)) }}</div>
                    </div>

                    <!-- Botón eliminar modal trigger -->
                    <button class="btn-eliminar" data-bs-toggle="modal" data-bs-target="#modal{{$comentario->id}}">
                        Eliminar
                    </button>

                    <!-- Modal eliminar -->
                    <div class="modal fade" id="modal{{$comentario->id}}" tabindex="-1" aria-labelledby="modalLabel{{$comentario->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{$comentario->id}}">Eliminar comentario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Desea realmente eliminar el comentario "{{ $texto }}"?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="specie_id" value="{{ $specie->id }}">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    <div class="comentarios-form">
        <form action="{{ route('comentarios.store') }}" method="POST">
            @csrf
            <textarea name="comentario" id="comentario" maxlength="200" placeholder="Escribe un comentario..." class="@error('comentario') is-invalid @enderror"></textarea>
            @error('comentario')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <input type="hidden" name="specie_id" value="{{ $specie->id }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <button type="submit">Comentar</button>
        </form>
    </div>

    <a href="{{ route('admin.especies.index') }}" class="btn btn-secondary">Salir</a>
</div>
@endsection
