@extends('layouts.app')

@section('title', 'Datos del Usuario')

@section('content')
    <div class="container">
        <h1>Información personal de {{$usuario->name}}</h1>
        <hr>

        <form action="{{ isset($informacion)? route('informacion.update', $informacion->id) : route('informacion.store')}}" method="POST">
            @csrf
            @if(isset($informacion))
                @method('put')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="preferencias" class="form-label">Preferencias</label>
                    <input type="text" class="form-control" id="preferencias" name="preferencias" value="{{isset($informacion) ? $informacion->preferencias : old('preferencias')}}" maxlength="100" placeholder="Ejemplo: Música, Cine, Lectura">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{isset($informacion) ? $informacion->fecha_nacimiento : old('fecha_nacimiento')}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="alias" class="form-label">Alias</label>
                    <input type="text" class="form-control" id="alias" name="alias"  maxlength="30" placeholder="Ejemplo: El Profe" value="{{isset($informacion) ? $informacion->alias : old('alias')}}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"  maxlength="15" placeholder="Ejemplo: +504 9876-5432" value="{{isset($informacion) ? $informacion->telefono : old('telefono')}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="idiomas" class="form-label">Idiomas aprendidos</label>
                    <input type="text" class="form-control" id="idiomas" name="idiomas"  maxlength="50" placeholder="Ejemplo: Español, Inglés" value="{{isset($informacion) ? $informacion->idiomas : old('idiomas')}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ocupacion" class="form-label">Ocupación</label>
                    <input type="text" class="form-control" id="ocupacion" name="ocupacion"  maxlength="30" placeholder="Ejemplo: Ingeniero de Software" value="{{isset($informacion) ? $informacion->ocupacion : old('ocupacion')}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="deportes" class="form-label">Deportes Favoritos</label>
                    <input type="text" class="form-control" id="deportes" name="deportes"  maxlength="60" placeholder="Ejemplo: Fútbol, Baloncesto" value="{{isset($informacion) ? $informacion->deportes : old('deportes')}}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="animal_favorito" class="form-label">Animal Favorito</label>
                    <input type="text" class="form-control" id="animal_favorito" name="animal_favorito"  maxlength="30" placeholder="Ejemplo: Perro" value="{{isset($informacion) ? $informacion->animal_favorito : old('animal_favorito')}}">
                </div>
            </div>
            <div>
                <input type="hidden" name="user_id" id="user_id" value="{{$usuario->id}}">
            </div>

            <hr>

            <button type="submit" class="btn btn-primary">{{isset($informacion) ? 'Actualizar' : 'Guardar'}}</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
