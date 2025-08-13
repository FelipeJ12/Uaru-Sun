@php
$items = [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Bitácora del Sistema'] // Última miga
    ];
    $title = 'Bitácora del Sistema'; 
@endphp

@extends('layouts.app')

@section('title', 'Bitácora')

@section('content')
<div class="container mt-5">

    <!-- Botón de regresar -->
    <a href="{{ url()->previous() }}" class="btn btn-outline-light mb-3">
        <i class="fas fa-arrow-left me-1"></i> Regresar
    </a>

    @if($registros->isEmpty())
        <p class="text-white">No hay registros para mostrar.</p>
    @else
    <style>
        /* Estilos exactos aplicados a la tabla para transparencia real */
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
                background-color: rgba(197, 208, 175, 0.8); /* verde claro semitransparente */

            border-color: rgba(255, 255, 255, 0.2);
        }
    </style>

    <table class="table table-bordered bitacora-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
            <tr>
                <td>{{ $registro->fecha }}</td>
                <td>{{ $registro->usuario }}</td>
                <td>{{ $registro->accion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
