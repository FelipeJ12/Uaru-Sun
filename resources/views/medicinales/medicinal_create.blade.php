@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Plantas Medicinales', 'url' => route('medicinas.index')],
    ['label' => isset($medicina) ? 'Editar Planta' : 'Registrar Planta']
];
$title = isset($medicina) ? 'Editar Planta Medicinal' : 'Registrar Planta Medicinal';
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
    max-width: 750px;
    background: rgba(30, 28, 28, 0.85);
    padding: 35px 40px;
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

input:focus, textarea:focus, input[type="file"]:focus {
    outline: none;
    border-color: #81c784;
    box-shadow: 0 0 8px #81c784;
}

textarea { min-height: 80px; }

.btn-success, .btn-secondary {
    border-radius: 10px;
    padding: 10px 30px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-success { background-color: #28a745; border-color: #28a745; color: white; }
.btn-success:hover { background-color: #218838; border-color: #1e7e34; }

.btn-secondary { background-color: #6c757d; border-color: #6c757d; color: white; }
.btn-secondary:hover { background-color: #5a6268; border-color: #545b62; }

.text-danger {
    font-size: 0.9rem;
    color: #f44336;
    margin-top: 5px;
    display: none;
}

.is-invalid { border-color: #f44336 !important; box-shadow: 0 0 8px #f44336 !important; }

.preview-img {
    max-width: 250px;
    height: auto;
    margin-top: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    display: none;
    object-fit: cover;
}
.alert-info {
    background-color: rgba(135, 206, 235, 0.2);
    color: #e0f7fa;
    border: 1px solid #81c784;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 25px;
}
</style>

<div class="form-container">
    <h2>{{ isset($medicina) ? 'Editar Planta Medicinal' : 'Registrar Nueva Planta' }}</h2>

    <div class="alert alert-info">
        <strong>Importante:</strong> Este formulario está destinado a registrar información sobre <strong>plantas medicinales</strong>. Asegúrate de que los datos sean reales y útiles.
    </div>

    <form action="{{ isset($medicina) ? route('medicinas.update', $medicina->id) : route('medicinas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($medicina))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre_comun">Nombre común</label>
            <input type="text" class="form-control @error('nombre_comun') is-invalid @enderror" id="nombre_comun" name="nombre_comun"
                   value="{{ old('nombre_comun', $medicina->nombre_comun ?? '') }}"
                   placeholder="Ejemplo: Manzanilla" maxlength="100">
            @error('nombre_comun')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="nombre_cientifico">Nombre científico</label>
            <input type="text" class="form-control @error('nombre_cientifico') is-invalid @enderror" id="nombre_cientifico" name="nombre_cientifico"
                   value="{{ old('nombre_cientifico', $medicina->nombre_cientifico ?? '') }}"
                   placeholder="Ejemplo: Matricaria chamomilla" maxlength="100">
            @error('nombre_cientifico')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="usos_medicinales">Usos medicinales</label>
            <textarea class="form-control @error('usos_medicinales') is-invalid @enderror" id="usos_medicinales" name="usos_medicinales" rows="3"
                      placeholder="Ejemplo: Ayuda a calmar dolores estomacales, insomnio, y ansiedad." maxlength="400">{{ old('usos_medicinales', $medicina->usos_medicinales ?? '') }}</textarea>
            @error('usos_medicinales')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="parte_utilizada">Parte utilizada</label>
            <input type="text" class="form-control @error('parte_utilizada') is-invalid @enderror" id="parte_utilizada" name="parte_utilizada"
                   value="{{ old('parte_utilizada', $medicina->parte_utilizada ?? '') }}"
                   placeholder="Ejemplo: Flores, hojas" maxlength="100">
            @error('parte_utilizada')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="forma_de_uso">Forma de uso</label>
            <textarea class="form-control @error('forma_de_uso') is-invalid @enderror" id="forma_de_uso" name="forma_de_uso" rows="3"
                      placeholder="Ejemplo: Infusión de las flores en agua caliente durante 5 minutos." maxlength="400">{{ old('forma_de_uso', $medicina->forma_de_uso ?? '') }}</textarea>
            @error('forma_de_uso')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="imagen">Imagen de la planta</label>
            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
            @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <div id="contenedor_imagen" style="display: none; margin-top: 20px;">
                <div style="font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.5rem;">🌿</span>
                    <span>Vista previa de la imagen:</span>
                </div>
                <img id="vista_previa" src="" alt="Vista previa" class="preview-img">
            </div>
        </div>

        <div class="mb-3">
            <label for="contraindicaciones">Contraindicaciones</label>
            <input type="text" class="form-control @error('contraindicaciones') is-invalid @enderror" id="contraindicaciones" name="contraindicaciones"
                   value="{{ old('contraindicaciones', $medicina->contraindicaciones ?? '') }}"
                   placeholder="Ejemplo: Evitar durante el embarazo o en personas alérgicas a las plantas compuestas." maxlength="100">
            @error('contraindicaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('medicinas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">{{ isset($medicina) ? 'Actualizar Medicina' : 'Guardar Planta' }}</button>
        </div>
    </form>
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
