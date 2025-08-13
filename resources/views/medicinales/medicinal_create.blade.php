@php
    $title = 'Registrar Planta Medicinal'; 
@endphp

@extends('layouts.app')

@section('title', isset($medicina) ? 'Editar Medicina' : 'Agregar planta')

@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        </div>
        <div class="alert alert-info">
            <strong>Importante:</strong> Este formulario está destinado a registrar información sobre <strong>plantas medicinales</strong>. Asegúrate de que los datos sean reales y útiles.
        </div>

        <hr>

        <form action="{{ isset($medicina) ? route('medicinas.update', $medicina->id) : route('medicinas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($medicina))
                @method('PUT')
            @endif

            <div class="mb-3 text-white">
                <label for="nombre_comun" class="form-label">Nombre común</label>
                <input type="text" class="form-control @error('nombre_comun') is-invalid @enderror" id="nombre_comun" name="nombre_comun"
                       value="{{ old('nombre_comun', $medicina->nombre_comun ?? '') }}"
                       placeholder="Ejemplo: Manzanilla" maxlength="100">
                @error('nombre_comun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="nombre_cientifico" class="form-label">Nombre científico</label>
                <input type="text" class="form-control @error('nombre_cientifico') is-invalid @enderror" id="nombre_cientifico" name="nombre_cientifico"
                       value="{{ old('nombre_cientifico', $medicina->nombre_cientifico ?? '') }}"
                       placeholder="Ejemplo: Matricaria chamomilla" maxlength="100">
                @error('nombre_cientifico')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="usos_medicinales" class="form-label">Usos medicinales</label>
                <textarea class="form-control @error('usos_medicinales') is-invalid @enderror" id="usos_medicinales" name="usos_medicinales" rows="3"
                          placeholder="Ejemplo: Ayuda a calmar dolores estomacales, insomnio, y ansiedad." maxlength="400">{{ old('usos_medicinales', $medicina->usos_medicinales ?? '') }}</textarea>
                @error('usos_medicinales')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="parte_utilizada" class="form-label">Parte utilizada</label>
                <input type="text" class="form-control @error('parte_utilizada') is-invalid @enderror" id="parte_utilizada" name="parte_utilizada"
                       value="{{ old('parte_utilizada', $medicina->parte_utilizada ?? '') }}"
                       placeholder="Ejemplo: Flores, hojas" maxlength="100">
                @error('parte_utilizada')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="forma_de_uso" class="form-label">Forma de uso</label>
                <textarea class="form-control @error('forma_de_uso') is-invalid @enderror" id="forma_de_uso" name="forma_de_uso" rows="3"
                          placeholder="Ejemplo: Infusión de las flores en agua caliente durante 5 minutos." maxlength="400">{{ old('forma_de_uso', $medicina->forma_de_uso ?? '') }}</textarea>
                @error('forma_de_uso')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="imagen" class="form-label">Imagen de la planta</label>
                <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="mb-3 text-white">
            <div id="contenedor_imagen" style="display: none; margin-top: 20px;">
                <div style="font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.5rem;">🌿</span>
                    <span>Vista previa de la imagen:</span>
                </div>
                <img id="vista_previa" src="" alt="Vista previa" style="max-width: 350px; height: auto; border: 1px solid #ccc; padding: 10px;">
            </div>

            <div class="mb-3 text-white">
                <label for="contraindicaciones" class="form-label">Contraindicaciones</label>
                <input type="text" class="form-control @error('contraindicaciones') is-invalid @enderror" id="contraindicaciones" name="contraindicaciones"
                       value="{{ old('contraindicaciones', $medicina->contraindicaciones ?? '') }}"
                       placeholder="Ejemplo: Evitar durante el embarazo o en personas alérgicas a las plantas compuestas." maxlength="100">
                @error('contraindicaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-success">{{ isset($medicina) ? 'Actualizar Medicina' : 'Guardar Planta' }}</button>
            <a href="{{ route('medicinas.index') }}" class="btn btn-secondary">Cancelar</a>
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
