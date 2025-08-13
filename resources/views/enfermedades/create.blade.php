@php
    $title = 'Registrar Enfermedad en Planta'; 
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
    }

    .d-flex.justify-content-between.mt-4 a,
    .d-flex.justify-content-between.mt-4 button {
        flex: 1 1 45%;
        text-align: center;
    }

    #preview {
        margin-top: 15px;
        max-width: 250px;
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

    <form action="{{ route('enfermedades.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="mb-4">
            <label for="nombre_planta">Nombre de la planta</label>
            <input type="text" id="nombre_planta" name="nombre_planta" class="form-control" required value="{{ old('nombre_planta') }}">
            @error('nombre_planta')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nombre_enfermedad">Nombre de la enfermedad</label>
            <input type="text" id="nombre_enfermedad" name="nombre_enfermedad" class="form-control" required value="{{ old('nombre_enfermedad') }}">
            @error('nombre_enfermedad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="sintomas">Síntomas</label>
            <textarea id="sintomas" name="sintomas" class="form-control" required>{{ old('sintomas') }}</textarea>
            @error('sintomas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="causas">Causas (opcional)</label>
            <textarea id="causas" name="causas" class="form-control">{{ old('causas') }}</textarea>
            @error('causas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="solucion">Solución</label>
            <textarea id="solucion" name="solucion" class="form-control" required>{{ old('solucion') }}</textarea>
            @error('solucion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="imagen">Imagen (opcional)</label>
            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
            <img id="preview" alt="Previsualización de imagen">
            @error('imagen')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('enfermedades.index') }}" class="btn-secondary-custom">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
            <button type="submit" class="btn-custom">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('imagen').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
</script>
@endsection
