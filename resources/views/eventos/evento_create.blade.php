@extends('layouts.app')

@section('title', isset($evento) ? 'Editar Evento' : 'Crear Evento')

@section('content')
    <div class="container" style="margin-top: 50px">

        <div class="alert alert-primary">
            <strong>Nota:</strong> Este formulario sirve para {{ isset($evento) ? 'editar' : 'registrar' }} eventos importantes relacionados con actividades en áreas protegidas.
        </div>

        <hr>

        <form action="{{ isset($evento) ? route('eventos.update', $evento->id) : route('eventos.store') }}" method="POST">
            @csrf
            @if(isset($evento))
                @method('PUT')
            @endif

            <div class="mb-3 text-white">
                <label for="descripcion" class="form-label">Descripción del evento</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror"
                          id="descripcion"
                          name="descripcion"
                          rows="2"
                          maxlength="100"
                          placeholder="Ejemplo: Reunión para planificación de reforestación, visita de inspección al sector norte del parque, etc.">{{ old('descripcion', isset($evento) ? $evento->descripcion : '') }}</textarea>
                @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="fecha_evento" class="form-label">Fecha del evento</label>
                <input type="date"
                       class="form-control @error('fecha_evento') is-invalid @enderror"
                       id="fecha_evento"
                       name="fecha_evento"
                       value="{{ old('fecha_evento', isset($evento) ? $evento->fecha_evento : '') }}"
                       min="{{ date('Y-m-d') }}">
                @error('fecha_evento')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="hora_evento" class="form-label">Hora del evento</label>
                <input type="time"
                       class="form-control @error('hora_evento') is-invalid @enderror"
                       id="hora_evento"
                       name="hora_evento"
                       value="{{ old('hora_evento', isset($evento) ? $evento->hora_evento : '') }}">
                @error('hora_evento')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3 text-white">
                <label for="direccion" class="form-label">Dirección exacta del evento</label>
                <textarea class="form-control @error('direccion') is-invalid @enderror"
                          id="direccion"
                          name="direccion"
                          rows="2"
                          maxlength="200"
                          placeholder="Ejemplo: Sector sur del Parque Nacional La Tigra, cerca del mirador principal.">{{ old('direccion', isset($evento) ? $evento->url : '') }}</textarea>
                @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-success">
                {{ isset($evento) ? 'Actualizar Evento' : 'Guardar Evento' }}
            </button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
