@php
    $title = 'Crear Actividad Ilegal'; 
@endphp

@extends('layouts.app')

@section('title', isset($reporte) ? 'Editar Reporte' : 'Crear Reporte')

@section('content')
    <div class="container" style="margin-top: 50px">

        <div class="alert alert-warning">
            <strong>Importante:</strong> Este formulario está destinado a reportar actividades ilegales relacionadas con la <strong>caza furtiva</strong> o la <strong>deforestación</strong>. Por favor, proporciona información precisa y verificable.
        </div>

        <hr>

        <form action="{{ isset($reporte) ? route('reportes.update', $reporte->id) : route('reportes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($reporte))
                @method('PUT')
            @endif

            <div class="mb-3 text-white">
                <label for="direccion" class="form-label">Dirección / Ubicación Exacta</label>
                <textarea class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" rows="2" maxlength="400"
                          placeholder="Ejemplo: Sendero El Cangrejal, Parque Nacional La Tigra, Francisco Morazán, cerca del mirador...">{{ old('direccion', $reporte->direccion ?? '') }}</textarea>
                @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="actividad" class="form-label">Tipo de Actividad Ilegal</label>
                <select class="form-select @error('actividad') is-invalid @enderror" id="actividad" name="actividad">
                    <option value="">-- Selecciona una actividad --</option>
                    <option value="Caza" {{ old('actividad', $reporte->actividad ?? '') === 'Caza' ? 'selected' : '' }}>Caza furtiva</option>
                    <option value="Deforestacion" {{ old('actividad', $reporte->actividad ?? '') === 'Deforestacion' ? 'selected' : '' }}>Deforestación</option>
                </select>
                @error('actividad')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="imagen" class="form-label">Evidencia fotográfica (opcional)</label>
                <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
             <div class="mb-3 text-white">
            <div id="contenedor_imagen" style="display: none; margin-top: 20px;">
                <div style="font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.5rem;">📸</span>
                    <span>Vista previa de la imagen:</span>
                </div>
                <img id="vista_previa" src="" alt="Vista previa" style="max-width: 350px; height: auto; border: 1px solid #ccc; padding: 10px;">
            </div>

            <hr>
            <button type="submit" class="btn btn-success">{{ isset($reporte) ? 'Actualizar Reporte' : 'Guardar Reporte' }}</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
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
