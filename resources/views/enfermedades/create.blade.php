@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Enfermedades de Plantas', 'url' => route('enfermedades.index')],
    ['label' => 'Crear Enfermedad']
];

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
    background: rgba(30, 28, 28, 0.85);
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
    color: #b5e7a0;
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

textarea { min-height: 80px; }

.text-danger {
    font-size: 0.9rem;
    color: #f44336;
    margin-top: 5px;
    display: block;
}
</style>

<div class="form-container">
    <h2>{{ $title }}</h2>

    <form action="{{ route('enfermedades.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- ✅ NOMBRE COMÚN (SIN SÍMBOLOS Y MÁXIMO 50) -->
        <div class="mb-4">
            <label for="nombre_planta">Nombre de la planta</label>
            <input type="text"
                   id="nombre_planta"
                   name="nombre_planta"
                   maxlength="50"
                   pattern="[A-Za-z0-9\s]+"
                   title="Solo se permiten letras y números"
                   required
                   value="{{ old('nombre_planta') }}">
            @error('nombre_planta')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ✅ NOMBRE ENFERMEDAD -->
        <div class="mb-4">
            <label for="nombre_enfermedad">Nombre de la enfermedad</label>
            <input type="text"
                   id="nombre_enfermedad"
                   name="nombre_enfermedad"
                   maxlength="50"
                   required
                   value="{{ old('nombre_enfermedad') }}">
            @error('nombre_enfermedad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ✅ SÍNTOMAS -->
        <div class="mb-4">
            <label for="sintomas">Síntomas</label>
        <textarea id="sintomas"
          name="sintomas"
          maxlength="150"
          pattern="[A-Za-z0-9\s.,áéíóúÁÉÍÓÚñÑ]+"
          title="No se permiten caracteres especiales (@, #, $, %, &, etc.)"
          required>{{ old('sintomas') }}</textarea>
            @error('sintomas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ✅ CAUSAS -->
        <div class="mb-4">
            <label for="causas">Causas (opcional)</label>
            <textarea id="causas" name="causas" maxlength="150">{{ old('causas') }}</textarea>
            @error('causas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ✅ SOLUCIÓN -->
        <div class="mb-4">
            <label for="solucion">Solución</label>
            <textarea id="solucion" name="solucion" maxlength="150" required>{{ old('solucion') }}</textarea>
            @error('solucion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ✅ IMAGEN -->
        <div class="mb-4">
            <label for="imagen">Imagen (opcional)</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
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



@endsection