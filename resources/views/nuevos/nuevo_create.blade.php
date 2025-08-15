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
body {
    background: url('{{ asset('images/fonds.jpg') }}') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form-container {
    background: rgba(30, 28, 28, 0.85);
    padding: 35px 40px;
    border-radius: 15px;
    max-width: 700px;
    margin: 50px auto;
    color: white;
    box-shadow: 0 8px 24px rgba(0,0,0,0.4);
}

.form-container h2 {
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

textarea, input[type="text"], input[type="email"], select {
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

textarea:focus, input:focus, select:focus {
    outline: none;
    border-color: #81c784;
    box-shadow: 0 0 8px #81c784;
}

.is-invalid { border-color: #f44336 !important; box-shadow: 0 0 8px #f44336 !important; }
.invalid-feedback { font-size: 0.9rem; color: #f44336; margin-top: 5px; }

.alert-custom {
    background: rgba(135, 206, 235, 0.2);
    border: 1px solid #81c784;
    color: #e0f7fa;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 25px;
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
    .btn-group > * { flex: 1 1 100%; }
}
</style>

<div class="form-container">
    <h2>{{ isset($nuevo) ? 'Editar Sugerencia' : 'Crear Sugerencia' }}</h2>

    <div class="alert-custom">
        <strong>Queremos mejorar:</strong> Ayúdanos a mejorar el sistema de biodiversidad en Honduras sugiriendo nuevas secciones o funcionalidades importantes.
    </div>

    <form action="{{ isset($nuevo) ? route('nuevos.update', $nuevo->id) : route('nuevos.store') }}" method="POST">
        @csrf
        @if(isset($nuevo))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="dato">¿Qué sección crees que deberíamos agregar?</label>
            <textarea class="form-control @error('dato') is-invalid @enderror" id="dato" name="dato" rows="3" maxlength="150"
                placeholder="Ejemplo: Añadir sección de monitoreo de especies invasoras, catálogo de flora por región, etc.">{{ old('dato', $nuevo->dato ?? '') }}</textarea>
            @error('dato')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        @if(isset($usuario) && $usuario->role === 'admin')
            <div class="mb-3">
                <label for="estado">Estado de la sugerencia</label>
                <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado">
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

        <div class="btn-group">
            <button type="submit" class="btn-custom">
                <i class="fas {{ isset($nuevo) ? 'fa-edit' : 'fa-paper-plane' }} me-2"></i>
                {{ isset($nuevo) ? 'Editar Sugerencia' : 'Enviar Sugerencia' }}
            </button>
            <a href="{{ route('nuevos.index') }}" class="btn-secondary-custom">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
