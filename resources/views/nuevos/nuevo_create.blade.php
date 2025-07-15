@extends('layouts.app')

@section('title', 'Sugerir Nueva Sección')

@section('content')
    <div class="container" style="margin-top: 50px">
        
            <div class="mb-3">

        <div class="alert alert-info">
            <strong>Queremos mejorar:</strong> Ayúdanos a mejorar el sistema de biodiversidad en Honduras sugiriendo nuevas secciones o funcionalidades que consideres importantes.
        </div>

        <hr>

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
                        <option value="Aprobada" {{ old('estado') == 'aprobado' ? 'selected' : '' }}>Aprobar</option>
                        <option value="Rechazada" {{ old('estado') == 'rechazado' ? 'selected' : '' }}>Rechazar</option>
                    </select>
                    @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div><input type="hidden" id="tipo" name="tipo" value="editar"></div>
            @else
                <div><input type="hidden" id="tipo" name="tipo" value="crear"></div>
            @endif


            <hr>
            <button type="submit" class="btn btn-success">{{isset($nuevo) ? 'Editar sugerencia' : 'Enviar Sugerencia'}}</button>
            <a href="{{ route('nuevos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
