@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Reportes de Actividades Ilegales', 'url' => route('reportes.index')],
    ['label' => isset($reporte) ? 'Editar Reporte' : 'Crear Actividad Ilegal']
];
$title = isset($reporte) ? 'Editar Reporte' : 'Crear Actividad Ilegal';
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
    padding: 35px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.4);
    margin: 50px auto;
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

input[type="text"], textarea, select, input[type="file"] {
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

input:focus, textarea:focus, select:focus {
    outline: none;
    border-color: #81c784;
    box-shadow: 0 0 8px #81c784;
}

.text-danger {
    font-size: 0.9rem;
    color: #f44336;
    margin-top: 5px;
}

.btn-custom, .btn-secondary-custom {
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

.btn-custom {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    border: none;
    box-shadow: 0 6px 15px rgba(22, 163, 74, 0.4);
}

.btn-custom:hover {
    background: linear-gradient(135deg, #15803d, #166534);
    transform: scale(1.05);
}

.btn-secondary-custom {
    background: linear-gradient(135deg, #4b4848ff, #5a5858ff);
    color: white;
    border: none;
    box-shadow: 0 6px 15px rgba(81, 83, 82, 0.4);
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

#vista_previa {
    max-width: 350px;
    height: auto;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 12px;
    display: block;
    margin: 15px auto 0 auto;
}

#contenedor_imagen { 
    display: none; 
    margin-top: 20px; 
}
.alert-custom {
    background: rgba(255, 193, 7, 0.2);
    border: 1px solid #ffc107;
    color: #ffc107;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
}
</style>

<div class="form-container">
    <h2>
        <i class="fas fa-exclamation-triangle me-2"></i>
        {{ isset($reporte) ? 'Editar Reporte' : 'Crear Actividad Ilegal' }}
    </h2>

    <div class="alert-custom">
        <strong>Importante:</strong> Este formulario está destinado a reportar actividades ilegales relacionadas con la <strong>caza furtiva</strong> o la <strong>deforestación</strong>. Proporciona información precisa.
    </div>

    <form action="{{ isset($reporte) ? route('reportes.update', $reporte->id) : route('reportes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($reporte))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="direccion">Dirección / Ubicación Exacta</label>
            <textarea id="direccion" name="direccion" rows="2" maxlength="400" placeholder="Ejemplo: Sendero El Cangrejal, Parque Nacional La Tigra..."
                      class="@error('direccion') is-invalid @enderror">{{ old('direccion', $reporte->direccion ?? '') }}</textarea>
            @error('direccion')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="actividad">Tipo de Actividad Ilegal</label>
            <select id="actividad" name="actividad" class="@error('actividad') is-invalid @enderror">
                <option value="">-- Selecciona una actividad --</option>
                <option value="Caza" {{ old('actividad', $reporte->actividad ?? '') === 'Caza' ? 'selected' : '' }}>Caza furtiva</option>
                <option value="Deforestacion" {{ old('actividad', $reporte->actividad ?? '') === 'Deforestacion' ? 'selected' : '' }}>Deforestación</option>
            </select>
            @error('actividad')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="imagen">Evidencia fotográfica (opcional)</label>
            <input type="file" id="imagen" name="imagen" class="@error('imagen') is-invalid @enderror">
            @error('imagen')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div id="contenedor_imagen">
            <div style="font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 1.5rem;">📸</span>
                <span>Vista previa de la imagen:</span>
            </div>
            <img id="vista_previa" src="" alt="Vista previa">
        </div>

        <div class="btn-group">
            <a href="{{ route('admin.especies.index') }}" class="btn-secondary-custom d-flex align-items-center justify-content-center">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>

            <button type="submit" class="btn-custom d-flex align-items-center justify-content-center" id="guardarBtn">
                <i class="fas fa-save me-2"></i> Guardar Reporte
            </button>
        </div>

<script>
document.getElementById('imagen').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (evt) {
            const vistaPrevia = document.getElementById('vista_previa');
            vistaPrevia.src = evt.target.result;
            document.getElementById('contenedor_imagen').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
