@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Mis Recomendaciones', 'url' => route('nuevos.index')],
    ['label' => isset($nuevo) ? 'Editar Sugerencia' : 'Crear Sugerencia']
];
$title = isset($nuevo) ? 'Editar Sugerencia' : 'Crear Sugerencia';
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
<style>
    .form-container {
        background: rgba(0, 0, 0, 0.6);
        padding: 25px;
        border-radius: 15px;
        max-width: 700px;
        margin: auto;
        color: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }
    .form-container h2 {
        color: #ffdd57;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }
    .form-container label {
        font-weight: bold;
    }
    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 5px #ffdd57;
    }
    .btn-group {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    .btn-custom {
        background-color: #28a745;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-custom:hover {
        background-color: #218838;
    }
    .btn-secondary-custom {
        background-color: #6c757d;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-secondary-custom:hover {
        background-color: #5a6268;
    }
    .alert-custom {
        background: rgba(255, 221, 87, 0.2);
        border: 1px solid #ffdd57;
        color: #ffdd57;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }
    .form-container h2 {
        color: #4CAF50; /* verde para el título */
    }
</style>

<div class="container" style="margin-top: 50px">
    <div class="form-container">
        <h2>{{ isset($nuevo) ? 'Editar Sugerencia' : 'Crear Sugerencia' }}</h2>

        <div class="alert-custom">
            <strong>Queremos mejorar:</strong> Ayúdanos a mejorar el sistema de biodiversidad en Honduras sugiriendo nuevas secciones o funcionalidades que consideres importantes.
        </div>

        <form action="{{ isset($nuevo) ? route('nuevos.update', $nuevo->id) : route('nuevos.store') }}" method="POST">
            @csrf
            @if(isset($nuevo))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="dato" class="form-label">¿Qué sección crees que deberíamos agregar?</label>
                <textarea class="form-control @error('dato') is-invalid @enderror" id="dato" name="dato" rows="3" maxlength="150"
                    placeholder="Ejemplo: Añadir una sección para monitoreo de especies invasoras, catálogo de flora por región, etc.">{{ isset($nuevo) ? $nuevo->dato : old('dato') }}</textarea>
                @error('dato')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            @if(isset($usuario) && $usuario->role === 'admin')
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado de la sugerencia</label>
                    <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="estado">
                        <option value="">Seleccione una opción</option>
                        <option value="Aprobada" {{ old('estado', $nuevo->estado ?? '') == 'Aprobada' ? 'selected' : '' }}>Aprobar</option>
                        <option value="Rechazada" {{ old('estado', $nuevo->estado ?? '') == 'Rechazada' ? 'selected' : '' }}>Rechazar</option>
                    </select>
                    @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <input type="hidden" id="tipo" name="tipo" value="editar">
            @else
                <input type="hidden" id="tipo" name="tipo" value="crear">
            @endif

            <div class="btn-group mt-4">
                <button type="submit" class="btn-custom">{{ isset($nuevo) ? 'Editar Sugerencia' : 'Enviar Sugerencia' }}</button>
                <a href="{{ route('nuevos.index') }}" class="btn-secondary-custom">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
