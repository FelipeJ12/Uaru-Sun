@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Mi Perfil', 'url' => route('profile.index')],
    ['label' => 'Actualizar Información']
];
$title = 'Actualizar Información';
@endphp

@extends('layouts.app')

@section('title', $title)

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
    margin: 50px auto;
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
input[type="email"], 
input[type="date"], 
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

input:focus, textarea:focus {
    outline: none;
    border-color: #81c784;
    box-shadow: 0 0 8px #81c784;
}

.img-thumbnail {
    max-width: 150px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    margin: 0 auto;
    display: block;
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

.btn-secondary-custom {
    background: #4a4a4a;
    color: #ccc;
    border: none;
    padding: 12px 25px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 9999px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: background 0.3s ease, color 0.3s ease;
    margin-top: 10px;
    text-align: center;
    display: inline-block;
    text-decoration: none;
    line-height: 1;
}

.btn-secondary-custom:hover { 
    background: #6b6b6b; 
    color: white; 
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
    text-align: center; 
}

@media (max-width: 576px) { 
    .btn-group > * { flex: 1 1 100%; } 
}
</style>

<div class="form-container">
    <h1>
        <i class="fas fa-user-edit me-2"></i>
        Actualizar Información de {{ $usuario->name }}
    </h1>

    <form action="{{ isset($informacion) ? route('informacion.update', $informacion->id) : route('informacion.store') }}"
          method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($informacion))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="usuario_name">Nombre</label>
            <input type="text" id="usuario_name" name="usuario_name"
                   value="{{ isset($informacion) ? $usuario->name : old('usuario_name') }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email"
                   value="{{ isset($informacion) ? $usuario->email : old('email') }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="preferencias">Preferencias</label>
            <input type="text" id="preferencias" name="preferencias"
                   value="{{ isset($informacion) ? $informacion->preferencias : old('preferencias') }}"
                   placeholder="Ejemplo: Flora, Fauna" maxlength="100">
        </div>

        <div class="mb-3">
    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
    <input type="date"
           id="fecha_nacimiento"
           name="fecha_nacimiento"
           max="{{ date('Y-m-d') }}"
           value="{{ isset($informacion) ? $informacion->fecha_nacimiento : old('fecha_nacimiento') }}">
</div>


        <div class="mb-3">
            <label for="alias">Alias</label>
            <input type="text" id="alias" name="alias"
                   value="{{ isset($informacion) ? $informacion->alias : old('alias') }}" maxlength="30">
        </div>

        <div class="mb-3">
    <label for="telefono">Teléfono</label>
    <input type="text"
           id="telefono"
           name="telefono"
           value="{{ isset($informacion) ? $informacion->telefono : old('telefono') }}"
           placeholder="Ejemplo: 98765432"
           maxlength="15"
           inputmode="numeric"
           pattern="[0-9]+"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
</div>


        <div class="mb-3">
            <label for="animal_favorito">Animal Favorito</label>
            <input type="text" id="animal_favorito" name="animal_favorito"
                   value="{{ isset($informacion) ? $informacion->animal_favorito : old('animal_favorito') }}"
                   placeholder="Ejemplo: Perro" maxlength="30">
        </div>

        <div class="mb-3">
            <label for="ocupacion">Ocupación</label>
            <input type="text" id="ocupacion" name="ocupacion"
                   value="{{ isset($informacion) ? $informacion->ocupacion : old('ocupacion') }}"
                   placeholder="Ejemplo: Ingeniero de Software" maxlength="30">
        </div>

        <div class="mb-3">
            <label for="foto_perfil">Foto de Perfil</label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(event)">
            <div class="mt-3 text-center">
                <img id="preview"
                     src="{{ isset($informacion) && $informacion->foto_perfil ? asset('storage/' . $informacion->foto_perfil) : '#' }}"
                     alt="Vista previa de la imagen"
                     class="img-thumbnail"
                     style="{{ (isset($informacion) && $informacion->foto_perfil) ? '' : 'display:none;' }}">
            </div>
        </div>

        <input type="hidden" name="user_id" value="{{ $usuario->id }}">

        <div class="btn-group">
            <a href="{{ route('profile.index') }}" class="btn-secondary-custom">Cancelar</a>
            <button type="submit" class="btn-custom">
                <i class="fas fa-save me-2"></i> {{ isset($informacion) ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    const output = document.getElementById('preview');
    reader.onload = function () {
        output.src = reader.result;
        output.style.display = 'block';
    };
    if (event.target.files.length > 0) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>
@endsection
