@php
$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Paisajes', 'url' => route('paisajes.index')],
        ['label' => 'Agregar Paisaje'] // Última miga
    ];
    $title = 'Agregar Paisajes'; 
@endphp

@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
        max-width: 700px;
        background: rgba(30, 28, 28, 0.8);
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        margin: 40px auto;
        color: white;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 700;
        color: #81c784;
        text-shadow: 1px 1px 4px #000;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px 14px;
        border-radius: 12px;
        border: 1.5px solid #2e7d32;
        background-color: rgba(255, 255, 255, 0.9);
        color: #1b5e20;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        resize: vertical;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus {
        outline: none;
        border-color: #81c784;
        box-shadow: 0 0 8px #81c784;
    }

    textarea {
        min-height: 100px;
    }

    .btn-custom {
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 9999px;
        cursor: pointer;
        box-shadow: 0 6px 15px rgba(22, 163, 74, 0.4);
        transition: background 0.3s ease, transform 0.2s ease;
        margin-top: 10px;
    }

    .btn-custom:hover {
        background: linear-gradient(135deg, #15803d, #166534);
        transform: scale(1.05);
    }

    .btn-custom:active {
        transform: scale(0.95);
        box-shadow: none;
    }

    .btn-secondary-custom {
        background: #4a4a4a;
        color: #ccc;
        border: none;
        padding: 12px 25px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 9999px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: background 0.3s ease, color 0.3s ease;
        margin-top: 10px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        background: #6b6b6b;
        color: white;
    }

    .btn-secondary-custom:active {
        transform: scale(0.95);
    }

    .d-flex.justify-content-between.mt-4 {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .d-flex.justify-content-between.mt-4 a,
    .d-flex.justify-content-between.mt-4 button {
        flex: 1 1 45%;
        text-align: center;
    }

    #vista_previa {
        margin-top: 15px;
        max-width: 350px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        display: none;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .d-flex.justify-content-between.mt-4 a,
        .d-flex.justify-content-between.mt-4 button {
            flex: 1 1 100%;
        }
    }
</style>

<div class="form-container">
    <h2>{{ isset($paisaje) ? 'Editar Paisaje: ' . $paisaje->nombres : 'Crear Nuevo Paisaje' }}</h2>

    <form action="{{ isset($paisaje) ? route('paisajes.update', $paisaje->id) : route('paisajes.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($paisaje))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="nombres">Nombre del Paisaje</label>
            <input type="text" id="nombres" name="nombres" class="form-control @error('nombres') is-invalid @enderror"
                value="{{ old('nombres', $paisaje->nombres ?? '') }}" maxlength="100" placeholder="Ejemplo: Bosque Nuboso">
            @error('nombres')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="imagen">Imagen del paisaje</label>
            <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
            @error('imagen')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <img id="vista_previa" alt="Vista previa">
        </div>

        <div class="mb-4">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3" maxlength="200" placeholder="Descripción">{{ old('descripcion', $paisaje->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ubicacion">Ubicación</label>
            <textarea id="ubicacion" name="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" rows="2" maxlength="400" placeholder="Ejemplo: https://www.google.com/maps/place/Ubicacion...">{{ old('ubicacion', $paisaje->ubicacion ?? '') }}</textarea>
            @error('ubicacion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <hr style="border-color: rgba(129,199,132,0.5);">

        <h4 class="mt-4" style="color: #81c784;">🌿 Flora</h4>
        <input type="hidden" name="flora_tipo" value="flora">
        <div class="mb-4">
            <label for="flora_nombre">Nombre de la Flora</label>
            <input type="text" id="flora_nombre" name="flora_nombre" class="form-control @error('flora_nombre') is-invalid @enderror"
                value="{{ old('flora_nombre', $flora->nombre ?? '') }}" maxlength="100" placeholder="Ejemplo: Helechos, Bromelias">
            @error('flora_nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <hr style="border-color: rgba(129,199,132,0.5);">

        <h4 class="mt-4" style="color: #81c784;">🦜 Fauna</h4>
        <input type="hidden" name="fauna_tipo" value="fauna">
        <div class="mb-4">
            <label for="fauna_nombre">Nombre de la Fauna</label>
            <input type="text" id="fauna_nombre" name="fauna_nombre" class="form-control @error('fauna_nombre') is-invalid @enderror"
                value="{{ old('fauna_nombre', $fauna->nombre ?? '') }}" maxlength="100" placeholder="Ejemplo: Tucanes, Monos aulladores">
            @error('fauna_nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('paisajes.index') }}" class="btn-secondary-custom">Cancelar</a>
            <button type="submit" class="btn-custom">{{ isset($paisaje) ? 'Actualizar Paisaje' : 'Guardar Paisaje' }}</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('imagen').addEventListener('change', function(event) {
        const archivo = event.target.files[0];
        const img = document.getElementById('vista_previa');

        if (archivo && archivo.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.style.display = 'block';
            }
            reader.readAsDataURL(archivo);
        } else {
            img.src = '';
            img.style.display = 'none';
        }
    });
</script>
@endsection
