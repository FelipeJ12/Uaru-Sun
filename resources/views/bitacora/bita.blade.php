@php
$items = [
    ['label' => 'Inicio', 'url' => route('home')],
    ['label' => 'Bitácora del Sistema']
];
$title = 'Bitácora del Sistema'; 
@endphp

@extends('layouts.app')

@section('title', 'Bitácora')

@section('content')
<div class="container mt-5">

    <!-- Botón de regresar -->
    

    <!-- Formulario de búsqueda estilo compacto -->
   <!-- Formulario de búsqueda más corto alineado a la izquierda -->
<form method="GET" action="{{ route('bitacora.index') }}" class="mb-3 d-flex">
    <div class="input-group input-group-sm" style="width: 250px;">
        <input type="text" name="buscar" class="form-control" 
               placeholder="Buscar usuario o acción..." 
               value="{{ request('buscar') }}">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>


    @if($registros->isEmpty())
        <p class="text-white">No hay registros para mostrar.</p>
    @else
    <style>
        .bitacora-table {
            background-color: transparent !important;
            color: white;
        }
        .bitacora-table thead th {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: white;
        }
        .bitacora-table tbody tr {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: white;
        }
        .bitacora-table td, .bitacora-table th {
            background-color: rgba(197, 208, 175, 0.8);
            border-color: rgba(255, 255, 255, 0.2);
        }
        .btn-sm i {
            margin-right: 0;
        }
    </style>

    <table class="table table-bordered table-sm bitacora-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
            <tr>
                <td>{{ $registro->fecha }}</td>
                <td>{{ $registro->usuario }}</td>
                <td>{{ $registro->accion }}</td>
                <td>
                    <form action="{{ route('bitacora.destroy', $registro->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
