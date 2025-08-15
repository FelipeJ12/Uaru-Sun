@php

$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Administrar Especies', 'url' => route('admin.especies.index')],
        ['label' => 'Editar Especie'] // Última miga
    ];
    $title = 'Editar Especie'; 
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
        background: rgba(30, 28, 28, 0.85);
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        margin: 40px auto 80px;
        color: white;
    }

    h1 {
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
        color: #b5e7a0;
    }

    input[type="text"],
    textarea,
    select,
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
    select:focus,
    input[type="file"]:focus {
        outline: none;
        border-color: #81c784;
        box-shadow: 0 0 8px #81c784;
    }

    textarea {
        min-height: 100px;
    }

    /* Botones actualizados */
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
        display: inline-block;
        text-align: center;
        line-height: 1;
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
        background: linear-gradient(135deg, #4b4848ff, #5a5858ff);
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 9999px;
        cursor: pointer;
        box-shadow: 0 6px 15px rgba(81, 83, 82, 0.4);
        transition: background 0.3s ease, transform 0.2s ease;
        margin-top: 10px;
        display: inline-block;
        text-decoration: none;
        text-align: center;
        line-height: 1;
    }

    .btn-secondary-custom:hover {
        background: #6b6b6b;
        color: white;
    }

    .btn-secondary-custom:active {
        transform: scale(0.95);
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .btn-group > * {
        flex: 1 1 45%;
    }

    @media (max-width: 576px) {
        .btn-group > * {
            flex: 1 1 100%;
        }
    }

    .alert-danger {
        background-color: #b71c1c;
        border-color: #7f0000;
        color: white;
        border-radius: 12px;
        padding: 15px 20px;
        box-shadow: 0 4px 15px rgba(183, 28, 28, 0.6);
        margin-bottom: 20px;
    }

    img.current-image {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.6);
        max-width: 150px;
        display: block;
        margin-bottom: 12px;
        object-fit: cover;
    }
</style>

<div class="form-container">
    <h1>Editar {{ $species->nombre }}</h1>

    <form action="{{ route('admin.especies.update', $species->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom:0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Nombre común -->
        <div class="mb-3">
            <label for="nombre">Nombre Común</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $species->nombre) }}" required>
        </div>

        <!-- Nombre Científico -->
        <div class="mb-3">
            <label for="nombre_cientifico">Nombre Científico</label>
            <input type="text" id="nombre_cientifico" name="nombre_cientifico" value="{{ old('nombre_cientifico', $species->nombre_cientifico) }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" required>{{ old('descripcion', $species->descripcion) }}</textarea>
        </div>

        <!-- Hábitat -->
        <div class="mb-3">
            <label for="habitat">Hábitat</label>
            <input type="text" id="habitat" name="habitat" value="{{ old('habitat', $species->habitat) }}" required>
        </div>

        <!-- Ubicación -->
        <div class="mb-3">
            <label for="location">Ubicación</label>
            <input type="text" id="location" name="location" value="{{ old('location', $species->location) }}" required>
        </div>

        <!-- Categoría -->
        <div class="mb-3">
            <label for="category_id">Categoría</label>
            <select id="category_id" name="category_id" required>
                <option value="" disabled {{ old('category_id', $species->category_id) ? '' : 'selected' }}>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $species->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->nombre }} ({{ $category->tipo }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Imagen -->
        <div class="mb-3">
            <label>Imagen Actual</label>
            <img src="{{ asset('storage/' . $species->image_path) }}" alt="Imagen actual" class="current-image">
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="btn-group">
            <a href="{{ route('admin.especies.index') }}" class="btn-secondary-custom">Regresar</a>
            <button type="submit" class="btn-custom">Actualizar</button>
        </div>
    </form>
</div>
@endsection
