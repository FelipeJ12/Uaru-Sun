@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Eventos Programados', 'url' => route('eventos.index')],
    ['label' => isset($evento) ? 'Editar Evento' : 'Crear Evento']
];
$title = isset($evento) ? 'Editar Evento' : 'Crear Evento';
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
    margin: 40px auto;
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
input[type="date"],
input[type="time"],
textarea {
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

input:focus,
textarea:focus {
    outline: none;
    border-color: #81c784;
    box-shadow: 0 0 8px #81c784;
}

textarea { min-height: 80px; }

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
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
}

.btn-custom:hover { 
    background: linear-gradient(135deg, #15803d, #166534);
    transform: scale(1.05);
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
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        text-decoration: none;
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
    .btn-group > * { 
        flex: 1 1 100%; 
    } 
}

.text-danger {
    font-size: 0.9rem;
    color: #f44336;
    margin-top: 5px;
    display: none;
}

.is-invalid {
    border-color: #f44336 !important;
    box-shadow: 0 0 8px #f44336 !important;
}
</style>

<div class="form-container">
    <h1>{{ $title }}</h1>

    <form action="{{ isset($evento) ? route('eventos.update', $evento->id) : route('eventos.store') }}" method="POST">
        @csrf
        @if(isset($evento))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="descripcion">Descripción del evento</label>
            <textarea id="descripcion" name="descripcion" rows="2" maxlength="100" required>{{ old('descripcion', isset($evento) ? $evento->descripcion : '') }}</textarea>
            <div class="text-danger" id="descripcionError">La descripción debe tener al menos 5 caracteres.</div>
        </div>

        <div class="mb-3">
            <label for="fecha_evento">Fecha del evento</label>
            <input type="date" id="fecha_evento" name="fecha_evento" value="{{ old('fecha_evento', isset($evento) ? $evento->fecha_evento : '') }}" min="{{ date('Y-m-d') }}" required>
            <div class="text-danger" id="fechaError">Seleccione una fecha válida.</div>
        </div>

        <div class="mb-3">
            <label for="hora_evento">Hora del evento</label>
            <input type="time" id="hora_evento" name="hora_evento" value="{{ old('hora_evento', isset($evento) ? $evento->hora_evento : '') }}" required>
            <div class="text-danger" id="horaError">Seleccione una hora válida.</div>
        </div>

        <div class="mb-3">
            <label for="direccion">Dirección exacta del evento</label>
            <textarea id="direccion" name="direccion" rows="2" maxlength="200" required>{{ old('direccion', isset($evento) ? $evento->direccion : '') }}</textarea>
            <div class="text-danger" id="direccionError">La dirección debe tener al menos 5 caracteres.</div>
        </div>

       <div class="btn-group">
            <a href="{{ route('admin.especies.index') }}" class="btn-secondary-custom d-flex align-items-center justify-content-center">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>

            <button type="submit" class="btn-custom d-flex align-items-center justify-content-center" id="guardarBtn">
                <i class="fas fa-save me-2"></i> Guardar
            </button>
        </div>
@endsection
