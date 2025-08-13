@php
    $title = 'Editar Perfil '; 
@endphp

@extends('layouts.app')

@section('title', 'Actualizar Información')

@section('content')
<style>
    body {
        background-image: url('{{ asset('images/fonds.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        max-width: 900px;
        margin: 50px auto;
        color: #333;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.5);
        outline: none;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 10px 30px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #b3b3b3;
        border-color: #999999;
    }

    h3 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 700;
        color: #28a745;
    }

    .img-thumbnail {
        max-width: 150px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        margin: 0 auto;
        display: block;
    }

    .text-center {
        text-align: center;
    }

    .row > .col-md-6 {
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="form-container">
        <h3>
            <i class="fas fa-user-edit me-2 text-success"></i>
            Actualizar Información de {{ $usuario->name }}
        </h3>

        <form action="{{ isset($informacion) ? route('informacion.update', $informacion->id) : route('informacion.store') }}"
              method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @if(isset($informacion))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6">
                    <label for="usuario_name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="usuario_name" name="usuario_name"
                           value="{{ isset($informacion) ? $usuario->name : old('usuario_name') }}" maxlength="100" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ isset($informacion) ? $usuario->email : old('email') }}" maxlength="100" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="preferencias" class="form-label">Preferencias</label>
                    <input type="text" class="form-control" id="preferencias" name="preferencias"
                           value="{{ isset($informacion) ? $informacion->preferencias : old('preferencias') }}"
                           placeholder="Ejemplo: Flora, Fauna" maxlength="100">
                </div>
                <div class="col-md-6">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                           value="{{ isset($informacion) ? $informacion->fecha_nacimiento : old('fecha_nacimiento') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="alias" class="form-label">Alias</label>
                    <input type="text" class="form-control" id="alias" name="alias"
                           value="{{ isset($informacion) ? $informacion->alias : old('alias') }}" maxlength="30">
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"
                           value="{{ isset($informacion) ? $informacion->telefono : old('telefono') }}"
                           placeholder="Ejemplo: +504 9876-5432" maxlength="15">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="animal_favorito" class="form-label">Animal Favorito</label>
                    <input type="text" class="form-control" id="animal_favorito" name="animal_favorito"
                           value="{{ isset($informacion) ? $informacion->animal_favorito : old('animal_favorito') }}"
                           placeholder="Ejemplo: Perro" maxlength="30">
                </div>
                <div class="col-md-6">
                    <label for="ocupacion" class="form-label">Ocupación</label>
                    <input type="text" class="form-control" id="ocupacion" name="ocupacion"
                           value="{{ isset($informacion) ? $informacion->ocupacion : old('ocupacion') }}"
                           placeholder="Ejemplo: Ingeniero de Software" maxlength="30">
                </div>
            </div>

            <div class="mb-3">
                <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage(event)">
                <div class="mt-3 text-center">
                    <img id="preview"
                         src="{{ isset($informacion) && $informacion->foto_perfil ? asset('storage/' . $informacion->foto_perfil) : '#' }}"
                         alt="Vista previa de la imagen"
                         class="img-thumbnail"
                         style="{{ (isset($informacion) && $informacion->foto_perfil) ? '' : 'display:none;' }}">
                </div>
            </div>

            <input type="hidden" name="user_id" value="{{ $usuario->id }}">

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">
                    <i class="fas fa-save me-2"></i> {{ isset($informacion) ? 'Actualizar' : 'Guardar' }}
                </button>
                <a href="{{ route('profile.index') }}" class="btn btn-secondary ms-2 px-4">
                    <i class="fas fa-arrow-left me-2"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
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
